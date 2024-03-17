<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KegiatanUser;
use App\Models\KetegoriChatOnServer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\PermissionModel as Permission;
use App\Models\RoleModel as Role;
use App\Models\StatusPegawai;
use Illuminate\Support\Facades\Validator;
use Mockery\Undefined;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Manage User', ['except' => ['delete_account']]);
    }

    public function register_user(Request $request)
    {
        $sektor = KetegoriChatOnServer::with('chanel')->get();
        $role = Role::all();
        $kegiatan = Kegiatan::get();
        $status_pegawai = StatusPegawai::get();

        // dd($sektor);

        if ($request->ajax()) {

            $data =
                User::select(['id', 'name', 'email', 'jabatan', 'penempatan', 'sektor', 'allowed', 'id_status_pegawai'])->with('roles', 'kegiatan.kegiatan', 'status_pegawai');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('aksi', function (User $row) {
                    $role = isset($row->roles[0]->name) ? $row->roles[0]->name : '-';
                    $status_pegawai = isset($row->status_pegawai->nama) ? $row->status_pegawai->nama : '-';
                    $btn = '<div class="row row-cards">
                        <div class="col-md-6 col-xl-6">
                        <a class="btn btn-tabler w-100 btn-icon" aria-label="Google" data-bs-toggle="modal" data-bs-target="#modalEditUsers"
                        onclick="editPegawai(' . $row->id . ',\'' . $row->name . '\',\'' . $row->email . '\',\'' . $row->penempatan . '\',\'' . base64_encode($row->kegiatan) . '\',\'' . $role . '\',\'' . $row->jabatan . '\',\'' . base64_encode($row->sektor) . '\',\'' . $row->allowed . '\',\'' . $status_pegawai  . '\')"><i class="fa fa-edit"></i></a></div>';
                    $csrf = csrf_field();

                    $deletee = '<input type="hidden" name="_method" value="DELETE">';

                    $btn .= '<div class="col-md-6 col-xl-6">
                        <form action="/dashboard/register" class="d-inline" method="POST">
                        ' . $csrf . $deletee . '
                        <button type="submit" class="btn btn-google w-100 btn-icon" aria-label="Tabler">
                        <i class="fa fa-trash"></i>
                        </button>
                        <input type="hidden" name="id" value="' . $row->id . '">
                        </div>
                        </div>';

                    return $btn;
                })
                ->addColumn('name', function (User $user) {
                    if ($user->name == '') {
                        return '';
                    } else {
                        return $user->name;
                    }
                })
                ->addColumn('email', function (User $user) {
                    if ($user->email == '') {
                        return '';
                    } else {
                        return $user->email;
                    }
                })
                ->addColumn('roles', function (User $user) {
                    if ($user->roles[0]->name == '') {
                        return '';
                    } else {
                        return $user->roles[0]->name;
                    }
                })
                ->addColumn('jabatan', function (User $user) {
                    if ($user->jabatan == '') {
                        return '';
                    } else {
                        return $user->jabatan;
                    }
                })
                ->addColumn('penempatan', function (User $user) {
                    if ($user->penempatan == '') {
                        return '';
                    } else {
                        return $user->penempatan;
                    }
                })
                ->rawColumns(['aksi', 'roles', 'jabatan', 'email', 'penempatan', 'name'])
                ->make(true);
        }

        return view('admin.registrasi.registrasi', compact(['role', 'kegiatan', 'sektor', 'status_pegawai']));
    }


    public function add_register_user(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'penempatan' => 'required',
            'jabatan' => 'required',
            'role' => 'required',
            'allowed' => 'required',
            'id_status_pegawai' => 'required',
        ]);

        if ($validate->fails()) {
            $alert_message = $validate->errors()->all();
            Alert::error('Input Gagal', $alert_message);
            return redirect()->route('register')->withErrors($validate);
        }

        $sektor_list = (array)$request->sektor;

        if (count($sektor_list) == 0) {
            $sektor = '{}';
        } else {
            $sektor = "{";
            foreach ($sektor_list as $s) {
                if ($s == end($sektor_list) or $s == current($sektor_list)) {
                    $sektor .= "$s";
                } else {
                    $sektor .= "$s,";
                }
            }
            $sektor .= "}";
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'penempatan' => $request->input('penempatan'),
            'jabatan' => $request->input('jabatan'),
            'sektor' => $sektor,
            'allowed' => $request->input('allowed'),
            'id_status_pegawai' => $request->input('id_status_pegawai'),
        ]);

        // dd($user);

        $role = $request->input('role');

        //Assign Role and Activity to User
        $user->assignRole($role);

        if ($role == 'super admin') {
            $user->givePermissionTo(Permission::all());
            KegiatanController::assignAll($user->id);
        } else {

            $kegiatan = $request->input('kegiatan');

            if (is_array($kegiatan) || is_object($kegiatan)) {
                foreach ($kegiatan as $k) {
                    $kegiatan = KegiatanController::getName($k);
                    $user->givePermissionTo($kegiatan);
                    KegiatanController::AssignKegiatan($user->id, $k);
                }
            }
        }


        return redirect()->route('register');
    }


    function show_register_user($id)
    {
        $datapegawai = User::findOrFail($id);
        return view('admin.registrasi.aksi_registrasi')->with(['data' => $datapegawai]);
    }


    public function update_register_user(Request $request)
    {
        $user = User::find($request->input('id'));

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->penempatan = $request->input('penempatan');
        $user->jabatan = $request->input('jabatan');
        $user->allowed = $request->input('allowed');
        $user->id_status_pegawai = $request->input('id_status_pegawai');

        $sektor_list = (array)$request->input('sektor');
        // dd($sektor);
        if (count($sektor_list) == 0) {
            $sektor = '{}';
        } else {
            $sektor = "{";
            foreach ($sektor_list as $s) {
                if ($s == end($sektor_list) or $s == current($sektor_list)) {
                    $sektor .= "$s";
                } else {
                    $sektor .= "$s,";
                }
            }
            $sektor .= "}";
        }
        $user->sektor = $sektor;

        $user->save();

        $user->syncRoles($request->input('role'));
        if ($request->input('role') == 'super admin') {
            $user->syncPermissions(Permission::all());
            KegiatanController::assignAll($user->id);
        } else {
            $user->revokePermissionTo(Permission::all());
            foreach ($request->input('kegiatan') as $k) {
                $kegiatan = KegiatanController::getName($k);
                $user->givePermissionTo($kegiatan);
                KegiatanController::AssignKegiatan($user->id, $k);
            }
        }

        return redirect()->route('register');
    }

    public function delete_register_user(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->delete();

        return redirect()->route('register');
    }

    public function delete_account()
    {
        return view('form-penghapusan-akun');
    }

    public function deleted_account()
    {
        $validate = Validator::make(request()->all(), [
            'email' => 'required',
            'reason' => 'required',
        ]);

        if ($validate->fails()) {
            $alert_message = $validate->errors()->all();
            Alert::error('Input Gagal', $alert_message);
            return redirect()->route('delete_account')->withErrors($validate);
        }

        $user = User::where('email', request()->email)->first();

        if ($user == null) {
            Alert::error('Email tidak ditemukan', 'Email tidak ditemukan');
            return redirect()->route('delete_account');
        }

        $user->allowed = 0;
        $user->save();

        Alert::success('Akun berhasil dihapus', 'Akun berhasil dihapus');

        return view('form-penghapusan-akun');
    }
}
