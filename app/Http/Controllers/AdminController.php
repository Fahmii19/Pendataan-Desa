<?php

namespace App\Http\Controllers;

use App\Models\KegiatanUser;
use App\Models\Kegiatan;
use App\Models\Tracking;
use App\Models\Survey;
use App\Models\User;
use App\Models\SurveyPerkembangan;
use App\Models\SurveyAksesibilitas;
use App\Models\SurveyPerkembanganImage;
use App\Models\SurveyAksesibilitasImage;
use App\Models\ProgresSurvey;
use App\Models\ViewDetil;
use App\Models\IzinLingkungan;
use App\Models\LogingAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\PinLocation;
use Google\Service\SemanticTile\Geometry;
use geometrey\jsonnb as GeometryJsonb;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('timeout');
        $this->middleware('permission:Survey Perkembangan Wilayah', ['only' => ['perkembangan_survey']]);
        $this->middleware('permission:Izin Lingkungan', ['only' => ['izin_lingkungan']]);
    }

    public function index()
    {
        return view('admin.aktivitas.aktivitas-login');
    }

    public function fetchSurveyer()
    {
        $surveyers = Survey::join('users', 'users.id', '=', 'tbl_kondisi_lingkungan.id_user')
            ->select('users.*', 'tbl_kondisi_lingkungan.*')
            ->orderBy('tbl_kondisi_lingkungan.id', 'Desc')
            ->take(1)
            ->get();

        return response()->json([
            'surveyer' => $surveyers,
        ]);
    }

    public function fetchPerkembangan()
    {

        // $perkembangan_surver = SurveyPerkembangan::join('users', 'users.id', '=', 'survey_perkembangan_wilayah.id_user')
        //     ->select('users.*', 'survey_perkembangan_wilayah.*')
        //     ->orderBy('survey_perkembangan_wilayah.id_user', 'Desc')
        //     ->get();

        $perkembangan_survey = SurveyPerkembangan::with(['user', 'image'])->orderBy('id_baru', 'DESC')->limit(1)->get();

        // dd($perkembangan_survey);

        return response()->json([
            'perkembangan' => $perkembangan_survey,
        ]);
    }

    public function dataAksesibilitas()
    {
        $data_aksesibilitas = SurveyAksesibilitas::with(['user', 'image'])->orderBy('id', 'DESC')->limit(1)->get();

        return response()->json([
            'aksesibilitas' => $data_aksesibilitas,
        ]);
    }

    public function dataTerbaru($id_data_terbaru)
    {
        $respon = Survey::join('users', 'users.id', '=', 'tbl_kondisi_lingkungan.id_user')
            ->select('users.*', 'tbl_kondisi_lingkungan.*')
            ->orderBy('tbl_kondisi_lingkungan.id', 'Desc')
            ->where('tbl_kondisi_lingkungan.id', $id_data_terbaru)
            ->take(1)
            ->get();

        return response()->json([
            'terbaru' => $respon,
        ]);
    }

    // belum update
    public function role_management()
    {
        return view('admin.role');
    }

    public function user_management()
    {
        $user = User::all();
        $role = Role::all();

        return view('admin.user', compact(['user', 'role']));
    }

    // public function add_user(Request $request)
    // {
    //     $user = User::create([
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password')),
    //     ]);

    //     $user->assignRole($request->input('role'));

    //     return redirect()->route('user');
    // }

    // public function update_user(Request $request)
    // {
    //     $user = User::find($request->input('id'));
    //     // dd($request->all());

    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->save();
    //     $user->syncRoles($request->input('role'));

    //     return redirect()->route('user');
    // }

    // public function delete_user(Request $request)
    // {
    //     $user = User::find($request->input('id'));
    //     $user->delete();

    //     return redirect()->route('user');
    // }

    // public function register_user(Request $request)
    // {

    //     $kecamatan = [
    //         'UP PMPTSP Kecamatan Kramat Jati',
    //         'UP PMPTSP Kecamatan Gambir',
    //         'UP PMPTSP Kecamatan Cipayung',
    //         'UP PMPTSP Kecamatan Grogol Petamburan',
    //         'UP PMPTSP Kecamatan Kebayoran Baru',
    //         'UP PMPTSP Kecamatan Mampang Prapatan',
    //         'UP PMPTSP Kecamatan Kelapa Gading',
    //         'UP PMPTSP Kecamatan Sawah Besar',
    //         'UP PMPTSP Kecamatan Kalideres',
    //         'UP PMPTSP Kecamatan Senen',
    //         'UP PMPTSP Kecamatan Pesanggrahan',
    //         'UP PMPTSP Kecamatan Kebon Jeruk',
    //         'UP PMPTSP Kecamatan Tebet',
    //         'UP PMPTSP Kecamatan Taman sari',
    //         'UP PMPTSP Kecamatan Koja',
    //         'UP PMPTSP Kecamatan Cilandak',
    //         'UP PMPTSP Kecamatan Tanah Abang',
    //         'UP PMPTSP Kecamatan Pancoran',
    //         'UP PMPTSP Kecamatan Makasar',
    //         'UP PMPTSP Kecamatan Menteng',
    //         'UP PMPTSP Kecamatan Jagakarsa',
    //         'UP PMPTSP Kecamatan Kebayoran Lama',
    //         'UP PMPTSP Kecamatan Kemayoran',
    //         'UP PMPTSP Kecamatan Tanjung Priok',
    //         'UP PMPTSP Kecamatan Jatinegara',
    //         'UP PMPTSP Kecamatan Cakung',
    //         'UP PMPTSP Kecamatan Cengkareng',
    //         'UP PMPTSP Kecamatan Tambora',
    //         'UP PMPTSP Kecamatan Ciracas',
    //         'UP PMPTSP Kecamatan Matraman',
    //         'UP PMPTSP Kecamatan Palmerah',
    //         'UP PMPTSP Kecamatan Kembangan',
    //         'UP PMPTSP Kecamatan Cempaka Putih',
    //         'UP PMPTSP Kecamatan Duren Sawit',
    //         'UP PMPTSP Kecamatan Pasar Minggu',
    //         'UP PMPTSP Kecamatan Pademangan',
    //         'UP PMPTSP Kecamatan Setiabudi',
    //         'UP PMPTSP Kecamatan Pulo Gadung',
    //         'UP PMPTSP Kecamatan Johar Baru',
    //         'UP PMPTSP Kecamatan Cilincing'
    //     ];

    //     $role = Role::all();

    //     if ($request->ajax()) {
    //         $data =
    //             User::select(['id', 'name', 'email', 'jabatan', 'penempatan'])->with('roles', 'kegiatan.kegiatan')->whereIn('id', function ($q) {
    //                 $q->select('id_user')->from(with(new KegiatanUser)->getTable());
    //             });
    //         return Datatables::eloquent($data)
    //             ->addIndexColumn()
    //             ->addColumn('aksi', function (User $row) {

    //                 $btn = '<div class="row row-cards">
    //                     <div class="col-md-6 col-xl-6">
    //                     <a class="btn btn-tabler w-100 btn-icon" aria-label="Google" data-bs-toggle="modal" data-bs-target="#modalEditUsers"
    //                     onclick="editPegawai(' . $row->id . ' ,\' ' . $row->name . ' \',\'' . $row->email . '\',\' ' . $row->penempatan . ' \')"><i class="fa fa-edit"></i></a>
    //                     </div>';

    //                 $csrf = csrf_field();

    //                 $input_hapus = '<input type="hidden" name="_method" value="DELETE">';

    //                 $btn .= '<div class="col-md-6 col-xl-6">
    //                     <form action="/dashboard/register" class="d-inline" method="POST">
    //                     ' . $csrf . $input_hapus . '
    //                     <button type="submit" class="btn btn-google w-100 btn-icon" aria-label="Tabler">
    //                     <i class="fa fa-trash"></i>
    //                     </button>
    //                     <input type="hidden" name="id" value="' . $row->id . '">
    //                     </div>
    //                     </div>';

    //                 return $btn;
    //             })->addColumn('roles', function (User $user) {
    //                 return $user->roles[0]->name;
    //             })->addColumn('kegiatan', function (User $user) {
    //                 return $user->kegiatan[0]->kegiatan->nama;
    //             })->rawColumns(['aksi', 'roles', 'kegiatan'])
    //             ->make(true);
    //     }

    //     return view('admin.pegawai', compact(['role', 'kecamatan']));
    // }

    public function kinerja_pegawai_ajib()
    {
        // $kelurahan = Survey::select('kelurahan')->groupBy('kelurahan')->get();
        $kelurahan = Survey::orderBy('kelurahan', 'DESC')->get()->whereNotNull('kelurahan')->groupBy('kelurahan');

        // dd($kelurahan);

        $pegawai_ajib = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'surveyer');
            }
        )
            // ->limit(20)
            ->get();

        return view('admin.kinerja', compact(['pegawai_ajib', 'kelurahan']));
    }

    public function track_cord()
    {
        DB::select('SET SESSION group_concat_max_len = 1000000000');
        $data = DB::select('SELECT  id_user, CONCAT("[",GROUP_CONCAT("[", kordinat ,"]"),"]") as kordinat FROM tracking GROUP BY id_user');

        return $data;
    }

    public function kinerja(Request $request)
    {
        if ($request->id == 0) {
            $data = Survey::all();
            return $data;
        } else {
            $data = Survey::where('id_user', $request->id)->get();
            return $data;
        }
    }


    public function aksesibilitas_perkelurahan()
    {
        // if ($request->ajax()) {

        $data_aksesibilitas = SurveyAksesibilitas::with(['image', 'user'])->get();

        // dd($data_aksesibilitas);

        return Datatables::of($data_aksesibilitas)
            // ->editColumn('foto', function ($data) {
            //     // Check if the image relationship is loaded, non-empty, and the first image's photo attribute is not null
            //     if (!empty($data->image) && isset($data->image[0]) && !is_null($data->image[0]->photo)) {
            //         return '<img src="https://jakarta.pintoinvest.com:9000/aksesibilitas/' . $data->image[0]->photo . '" width="100%" height="110px" />';
            //     }
            //     // Return the default 'not_image.png' if the above conditions are not met
            //     return '<img class="img_parents" style="width:490px !important;height: 300px; object-fit: cover;" src="https://jakarta.pintoinvest.com/survey/not_image.png" alt="First slide">';
            // })
            // ->rawColumns(['foto'])
            ->editColumn('kelurahan_aksesibilitas', function ($data) {
                $kel = $data->kelurahan;
                $get_kel = ucwords(strtolower($kel));
                return "$get_kel";
            })
            ->editColumn('kecamatan_aksesibilitas', function ($data) {
                $kec = $data->kecamatan;
                $get_kec = ucwords(strtolower($kec));
                return "$get_kec";
            })
            ->editColumn('kota_aksesibilitas', function ($data) {
                $kota = $data->kota;
                $get_kota = ucwords(strtolower($kota));
                return "$get_kota";
            })
            ->make(true);
    }

    public function kinerja_data(Request $request)
    {
        if ($request->ajax()) {

            $data = Survey::select(['judul', 'foto', 'kategori', 'catatan', 'permasalahan', 'solusi', 'kelurahan']);
            return Datatables::of($data)
                ->editColumn('foto', function ($data) {
                    return '<img src="https://jakarta.pintoinvest.com/mobile/img/' . $data->foto . '" width="100%" height="110px" />';
                })
                ->rawColumns(['foto'])
                ->make(true);
        }
    }


    public function pdf_aksesibilitas($kelurahan = null)
    {
        if ($kelurahan !== null) {
            $data = SurveyAksesibilitas::with('image')->where('kelurahan', $kelurahan)->get();
            // dd($data);
        } else {
            $data = SurveyAksesibilitas::all();
        }

        $opciones_ssl = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                'allow_self_signed' => TRUE,
            ),
        );

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->setPaper('portrait');
        $pdf->getDomPDF()->setHttpContext(stream_context_create($opciones_ssl));
        $pdf->loadView('admin.pdf_perkelurahan_aksesibilitas', compact('data'));

        return $pdf->stream();
    }

    public function pdf_kinerja($kelurahan = null)
    {
        if ($kelurahan !== null) {
            $data = Survey::select(['judul', 'foto', 'kategori', 'catatan', 'permasalahan', 'solusi', 'kelurahan'])
                ->where('kelurahan', $kelurahan)
                ->get();
        } else {
            $data = Survey::select(['judul', 'foto', 'kategori', 'catatan', 'permasalahan', 'solusi', 'kelurahan'])->get();
        }

        $opciones_ssl = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                'allow_self_signed' => TRUE,
            ),
        );

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->setPaper('portrait');
        $pdf->getDomPDF()->setHttpContext(stream_context_create($opciones_ssl));
        $pdf->loadView('admin.pdf_kinerja_ajib', compact('data'));

        return $pdf->stream();
    }

    public function kuesioner()
    {
        $data = Http::get(env('APP_URL') . ':4000/quiz')->json();

        return view('admin.kuesioner', compact('data'));
    }

    public function tambah_kuesioner()
    {
        return view('admin.tambah_kuesioner');
    }

    public function edit_kuesioner($id)
    {
        $data = Http::get(env('APP_URL') . ':4000/quiz/' . $id)->json();
        // dd($data);
        return view('admin.edit_kuesioner', compact('data'));
    }

    public function list_kuesioner()
    {
        return view('admin.list_kuesioner');
    }

    public function isi_kuesioner()
    {
        return view('admin.isi_kuesioner');
    }

    public function jawaban_kuesioner($id)
    {
        $quiz = Http::get(env('APP_URL') . ':4000/quiz/' . $id)->json();
        $response = Http::get(env('APP_URL') . ':4000/response/' . $id)->json();
        // return $data;
        return view('admin.jawaban_kuesioner', compact('quiz', 'response'));
    }

    public function perkembangan_survey()
    {
        // $hasil_jumlah_titik = SurveyPerkembangan::all();
        // $hasil_jumlah_titik = DB::table('survey_perkembangan_wilayah')->get();

        // $hasil_jumlah_titik = DB::connection('pgsql')->table('survey_perkembangan_wilayah')->count();
        // $get_perkembangan_day = DB::connection('pgsql')->table('survey_perkembangan_wilayah')->where('date', $get_today)->get();

        // dd($get_perkembangan_day->count());

        // $pegawai_ajib2 = User::withCount('perkembangan')->get();

        $hasil_jumlah_titik = SurveyPerkembangan::all()->count();
        $progres_total = $hasil_jumlah_titik / 82988 * 100;
        $get_progres_total = number_format((float)$progres_total, 2, '.', '');
        $get_tgl_perhari = date('Y-m-d');
        $get_perkembangan_day = SurveyPerkembangan::Where('date', $get_tgl_perhari)->get();

        $user_id = SurveyPerkembangan::select('id_user')->groupBy('id_user')->get();
        $count_ajib_terdaftar = User::whereHas(
            'kegiatan.kegiatan',
            function ($q) {
                $q->where('nama', 'Survey Perkembangan Wilayah');
            }
        )->whereIn('id', $user_id)->get();

        $slider_perkembangan = SurveyPerkembangan::with('image')->orderBy('id_baru', 'DESC')->take(100)->get();

        // $get_id = Survey::join('users', 'users.id', '=', 'tbl_kondisi_lingkungan.id_user')
        //     ->select('users.*', 'tbl_kondisi_lingkungan.*')
        //     ->orderBy('tbl_kondisi_lingkungan.id', 'Desc')
        //     ->get();

        return view('admin.survey.survei_perkembangan', compact(['get_progres_total', 'get_perkembangan_day', 'hasil_jumlah_titik', 'count_ajib_terdaftar', 'slider_perkembangan']));
    }

    public function pengawasan_satu(Request $request)
    {
        // Penempatan Ajib Kecamatan
        $kecamatan = [
            'UP PMPTSP Kecamatan Kramat Jati',
            'UP PMPTSP Kecamatan Gambir',
            'UP PMPTSP Kecamatan Cipayung',
            'UP PMPTSP Kecamatan Grogol Petamburan',
            'UP PMPTSP Kecamatan Kebayoran Baru',
            'UP PMPTSP Kecamatan Mampang Prapatan',
            'UP PMPTSP Kecamatan Kelapa Gading',
            'UP PMPTSP Kecamatan Sawah Besar',
            'UP PMPTSP Kecamatan Kalideres',
            'UP PMPTSP Kecamatan Senen',
            'UP PMPTSP Kecamatan Pesanggrahan',
            'UP PMPTSP Kecamatan Kebon Jeruk',
            'UP PMPTSP Kecamatan Tebet',
            'UP PMPTSP Kecamatan Taman sari',
            'UP PMPTSP Kecamatan Koja',
            'UP PMPTSP Kecamatan Cilandak',
            'UP PMPTSP Kecamatan Tanah Abang',
            'UP PMPTSP Kecamatan Pancoran',
            'UP PMPTSP Kecamatan Makasar',
            'UP PMPTSP Kecamatan Menteng',
            'UP PMPTSP Kecamatan Jagakarsa',
            'UP PMPTSP Kecamatan Kebayoran Lama',
            'UP PMPTSP Kecamatan Kemayoran',
            'UP PMPTSP Kecamatan Tanjung Priok',
            'UP PMPTSP Kecamatan Jatinegara',
            'UP PMPTSP Kecamatan Cakung',
            'UP PMPTSP Kecamatan Cengkareng',
            'UP PMPTSP Kecamatan Tambora',
            'UP PMPTSP Kecamatan Ciracas',
            'UP PMPTSP Kecamatan Matraman',
            'UP PMPTSP Kecamatan Palmerah',
            'UP PMPTSP Kecamatan Kembangan',
            'UP PMPTSP Kecamatan Cempaka Putih',
            'UP PMPTSP Kecamatan Duren Sawit',
            'UP PMPTSP Kecamatan Pasar Minggu',
            'UP PMPTSP Kecamatan Pademangan',
            'UP PMPTSP Kecamatan Setiabudi',
            'UP PMPTSP Kecamatan Pulo Gadung',
            'UP PMPTSP Kecamatan Johar Baru',
            'UP PMPTSP Kecamatan Cilincing'
        ];

        $register_user = User::withCount('survey')->whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'surveyer');
            }
        )->get();

        $slider_terbaru = Survey::join(
            'users',
            'users.id',
            '=',
            'tbl_kondisi_lingkungan.id_user'
        )->select('users.*', 'tbl_kondisi_lingkungan.*')->orderBy('tbl_kondisi_lingkungan.id', 'Desc')->get();

        // $pegawai_rekap_input = User::whereHas(
        //     'roles',
        //     function ($q) {
        //         $q->where('name', 'surveyer');
        //     }
        // )->get();

        $survey = Survey::all();
        $role = Role::all();
        $kegiatan = Kegiatan::get();
        $kelurahan = Survey::orderBy('kelurahan', 'DESC')->get()->whereNotNull('kelurahan')->groupBy('kelurahan');
        $loging = LogingAuth::with('user')->orderBy('time', 'DESC')->get();
        // dd($loging);

        return view('admin.survey.pengawasan_satu', compact(['register_user', 'survey', 'slider_terbaru', 'role', 'kecamatan', 'kegiatan', 'kelurahan']));
    }


    public function izin_lingkungan()
    {
        $status1 = 1; //hijau 	Berkas Sudah Terbit
        $status2 = 2; //merah  	Berkas Sudah Ditolak
        $status3 = 3; //merah Berkas Sudah Dibatalkan Sistem
        $status4 = 4; //kuning Berkas Sedang Diproses oleh Wilayah
        $status5 = 5; //orange Berkas Perlu Disposisi Pimpinan

        if ($status1 == 1) {
            $data_status1 = IzinLingkungan::with('arsip_file')->where("status", 1)->get();
            count($data_status1);
        }
        if ($status2 == 2) {
            $data_status2 = IzinLingkungan::with('arsip_file')->where("status", 2)->get();
            count($data_status2);
        }
        if ($status3 == 3) {
            $data_status3 = IzinLingkungan::with('arsip_file')->where("status", 3)->get();
            count($data_status3);
        }
        if ($status4 == 4) {
            $data_status4 = IzinLingkungan::with('arsip_file')->where("status", 4)->get();
            count($data_status4);
        }
        if ($status5 == 5) {
            $data_status5 = IzinLingkungan::has('arsip_file', '>=', 2)->where("status", 5)->get();
            count($data_status5);
        }

        // Total Titik Tercatat
        $query_titik_tercatat = IzinLingkungan::with('arsip_file')->whereNotNull('update_time')->get();
        $titik_tercatat = 1;

        // dd(count($query_titik_tercatat));

        foreach ($query_titik_tercatat as $q) {
            // $total_file = $q->arsip_file == null ? 0 : count($q->arsip_file);
            if ($q->status == 5) {
                if ($q->status_terbaru != null) {
                    $titik_tercatat++;
                }
            } else {
                $titik_tercatat++;
            }
        }


        // Titik Tercatat Hari Ini
        $get_tgl_perhari = date('Y-m-d');
        $titik_tercatat_izin = IzinLingkungan::join('users', 'users.id', '=', 'tbl_izin_lingkungan.id_user')
            ->select('users.*', 'tbl_izin_lingkungan.*')
            ->whereDate('tbl_izin_lingkungan.update_time', '=', $get_tgl_perhari)
            ->get();

        // Jumlah CPNS Terdaftar
        $count_jumlah_cpns = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'CPNS');
            }
        )->get();

        // Prosentase
        $prosentase = IzinLingkungan::all()->count();
        $progres_total_izin =  $titik_tercatat / $prosentase  * 100;
        $get_progres_total_izin = number_format((float)$progres_total_izin, 2, '.', '');

        return view('admin.izin_lingkungan', compact(['data_status1', 'data_status2', 'data_status3', 'data_status4', 'data_status5', 'titik_tercatat_izin', 'titik_tercatat', 'count_jumlah_cpns', 'get_progres_total_izin']));
    }

    public  function KinerjaCpns()
    {
        $count_kinerja_cpns = User::withCount(['lingkungan_perhari', 'lingkungan_total'])->whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'CPNS');
                $q->whereNotIn('penempatan', ['UP PMPTSP Kecamatan Cilincing', 'UP PMPTSP Kecamatan Cipayung', 'UP PMPTSP Kecamatan Pulogadung', 'UP PMPTSP Kecamatan Johar Baru']);
            }
        )->get();

        return Datatables::of($count_kinerja_cpns)->make(true);
    }




    public  function viewDetilCpns(Request $request)
    {

        if ($request->ajax()) {

            $data = IzinLingkungan::with('arsip_file')->leftJoin('users', 'users.id', '=', 'tbl_izin_lingkungan.id_user')->orderBy('update_time', 'Desc')->orderBy('nama_penanggung_jawab', 'Asc')->get();

            return Datatables::of($data)
                ->filter(function ($provider) use ($request) {
                    if ($request->get('status')) {
                    }
                })
                ->editColumn('kelurahan_kegiatan', function ($data) {
                    $kel = $data->kelurahan_kegiatan;
                    $get_kel = ucwords(strtolower($kel));
                    return "$get_kel";
                })
                ->editColumn('kecamatan_kegiatan', function ($data) {
                    $kec = $data->kecamatan_kegiatan;
                    $get_kec = ucwords(strtolower($kec));
                    return "$get_kec";
                })->addColumn('status', function ($data) {
                    $total_file = $data->arsip_file == null ? 0 : count($data->arsip_file);
                    if ($data->status == 5) {
                        if ($total_file >= 2) {
                            return 'Selesai';
                        } else {
                            return 'Belum Selesai';
                        }
                    } elseif ($data->status == 1 || $data->status == 2 || $data->status == 3 || $data->status == 4) {
                        return 'Selesai';
                    } elseif ($data->status == 0) {
                        return 'Belum Selesai';
                    }
                })
                ->rawColumns(['kelurahan_kegiatan', 'kecamatan_kegiatan', 'status'])->make(true);
        }
    }



    function ExportDetilInputCpns()
    {

        $data = IzinLingkungan::orderBy('update_time', 'Desc')->orderBy('nama_penanggung_jawab', 'Asc')->get();

        $data_array[] = array("Nama CPNS", "Tanggal Input", "No Permohonan", "Kode Izin", "Nama Perusahaan", "Alamat", "Kelurahan", "Kecamatan", "Tanggal Pengajuan", "Status Terakhir", "Komentar Terakhir", "Status Terbaru", "Komentar Terbaru");
        foreach ($data as $data_item) {

            $data_array[] = array(
                'Nama CPNS' => $data_item->nama_penanggung_jawab,
                'Tanggal Input' => $data_item->update_time == null ? '' : date("d-m-Y", strtotime($data_item->update_time)),
                'No Permohonan' => $data_item->nomor_permohonan,
                'Kode Izin' => $data_item->kode_izin,
                'Nama Perusahaan' => $data_item->nama_perusahaan,
                'Alamat' => $data_item->alamat_kegiatan_izin,
                'Kelurahan' => $data_item->kelurahan_kegiatan,
                'Kecamatan' => $data_item->kecamatan_kegiatan,
                'Tanggal Pengajuan' => $data_item->tanggal_pengajuan_izin == null ? '' : date("d-m-Y", strtotime($data_item->tanggal_pengajuan_izin)),
                'Status Terakhir' => $data_item->status_terakhir,
                'Komentar Terakhir' => $data_item->komentar_terakhir,
                'Status Terbaru' => $data_item->status_terbaru,
                'Komentar Terbaru' => $data_item->komentar_terbaru
            );
        }
        $this->ExportDetilIzinExcel($data_array);
    }

    public function ExportDetilIzinExcel($data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(25);
            $spreadSheet->getActiveSheet()->fromArray($data);

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];

            $spreadSheet->getActiveSheet()->getStyle('1:1')->applyFromArray($styleArray);

            $spreadSheet->getActiveSheet()->getStyle('B')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('D')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('G')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('I')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('K')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Detil Input CPNS.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function ExportKinerjaCpns()
    {

        $data = User::withCount(['lingkungan_perhari', 'lingkungan_total'])->whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'CPNS');
            }
        )->orderBy('name', 'ASC')->get();


        $data_array[] = array("Nama CPNS", "Penempatan", "Input Hari Ini", "Input Total");
        foreach ($data as $data_item) {

            $data_array[] = array(
                'Nama CPNS' => $data_item->name,
                'Penempatan' => $data_item->penempatan,
                'Input Hari Ini' => (string)$data_item->lingkungan_perhari_count,
                'Input Total' => (string)$data_item->lingkungan_total_count
            );
        }
        $this->ExportKinerjaCpnsExcel($data_array);
    }

    public function ExportKinerjaCpnsExcel($data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(25);
            $spreadSheet->getActiveSheet()->fromArray($data);

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];

            $spreadSheet->getActiveSheet()->getStyle('1:1')->applyFromArray($styleArray);

            $spreadSheet->getActiveSheet()->getStyle('C')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('D')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Kinerja CPNS.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }


    public  function viewSurvey()
    {
        $data_survey = ViewDetil::select("*")->orderBy('tanggal', 'Desc')->get();
        return Datatables::of($data_survey)
            ->editColumn('kelurahan', function ($data) {
                $kel = $data->kelurahan;
                $get_kel = ucwords(strtolower($kel));
                return "$get_kel";
            })
            ->editColumn('kecamatan', function ($data) {
                $kec = $data->kecamatan;
                $get_kec = ucwords(strtolower($kec));
                return "$get_kec";
            })
            ->editColumn('tanggal', function ($data) {
                $tgl = $data->tanggal;
                $tanggal = date("d-m-Y", strtotime($tgl));
                return "$tanggal";
            })
            ->rawColumns(['kelurahan', 'kecamatan', 'tanggal'])->make(true);

        // dd($data);
    }

    public function KinerjaAksesibilitas()
    {
        // $data_aksesibilitas = User::withCount(['harian_aksesibilitas', 'total_aksesibilitas'])->whereHas(
        //     'kegiatan.kegiatan',
        //     function ($q) {
        //         $q->where('nama', 'Survey Aksesibilitas');
        //     }
        // )->get();

        // return Datatables::of($data_aksesibilitas)->make(true);

        $today = now()->format('Y-m-d');
        $data_aksesibilitas = SurveyAksesibilitas::with(['user', 'image'])
            ->selectRaw('count(*) as harian, id_user, DATE(created_at) as date')
            ->whereDate('created_at', $today)
            ->groupBy(DB::raw('DATE(created_at)'), 'id_user')
            ->get();

        $total_aksesibilitas = SurveyAksesibilitas::selectRaw('count(*) as total, id_user')
            ->groupBy('id_user')
            ->get()
            ->keyBy('id_user');

        foreach ($data_aksesibilitas as $data) {
            $data->total = $total_aksesibilitas[$data->id_user]->total ?? 0;
        }

        return Datatables::of($data_aksesibilitas)
            ->addColumn('penempatan', function ($row) {
                return $row->user->penempatan ?? 'N/A';
            })
            ->addColumn('harian_aksesibilitas_count', function ($row) {
                return $row->harian;
            })
            ->addColumn('total_aksesibilitas_count', function ($row) {
                return $row->total;
            })
            ->make(true);
    }


    public  function KinerjaPetugas()
    {
        $data_kinerja = User::withCount(['perkembangan', 'perkembangan_today'])->with('roles')->whereHas(
            'kegiatan',
            function ($q) {
                $q->whereHas('kegiatan', function ($q) {
                    $q->where('nama', 'Survey Perkembangan Wilayah');
                });
            }
        )->get();

        return Datatables::of($data_kinerja)->make(true);
    }

    public  function ProgresSurvey()
    {
        $survey =  ProgresSurvey::withCount(['survey' => function ($query) {
            $query->select(DB::connection('pgsql')->raw('count(distinct(id_sub_blok))'));
        }, 'kelurahan', 'kecamatan'])->get();

        return Datatables::of($survey)
            ->editColumn('progres', function ($data) {

                // $hitung->select(DB::raw('count(distinct(ip))'));

                $progress = $data->survey_count / $data->jumlah * 100;

                return "<div class='progress progress-xs'><div class='progress-bar bg-primary' style='width: $progress%'></div></div>";
            })
            ->editColumn('persen', function ($data) {

                // $hitung->select(DB::raw('count(distinct(ip))'));

                $progress = $data->survey_count / $data->jumlah * 100;

                $convert = number_format((float)$progress, 2, '.', '');

                return "<span>$convert%</span>";
            })
            ->editColumn('nama_kel', function ($data) {
                $kel = $data->kelurahan;
                $kalimat = ucwords(strtolower($kel));
                return "$kalimat";
            })
            ->editColumn('nama_kec', function ($data) {
                $kel = $data->kecamatan;
                $kalimat = ucwords(strtolower($kel));
                return "$kalimat";
            })
            ->editColumn('survey_count_null', function ($data) {

                $kalimat = '';
                return "$kalimat";
            })
            ->rawColumns(['survey_count_null', 'progres', 'nama_kel', 'nama_kec', 'persen'])->make(true);

        // dd($survey);
    }

    public function dataSliderAksesibilitas($id_aksibilitas)
    {

        $data_aksesibilitas = SurveyAksesibilitas::with(['user', 'image'])->where('id', (int)$id_aksibilitas)->first();

        return response()->json([
            'aksesibilitas' => $data_aksesibilitas,
        ]);
    }

    public function dataPetaAksesibilitas()
    {
        $geojson_format = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        $data_aksesibilitas = SurveyAksesibilitas::selectRaw('id, ST_AsText(geometry) as geometry_text')->get();

        foreach ($data_aksesibilitas as $d) {

            if (preg_match('/POINT\(([^ ]+) ([^ ]+)\)/', $d->geometry_text, $matches)) {
                $lng = (float)$matches[1];
                $lat = (float)$matches[2];

                $value_data = [
                    'type' => "Feature",
                    'properties' => [
                        'id' => $d->id,
                    ],
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [$lng, $lat]
                    ]
                ];

                $geojson_format['features'][] = $value_data;
            } else {
                // Penanganan jika koordinat tidak ditemukan
                echo 'Koordinat tidak ditemukan untuk id ' . $d->id . '<br>';
            }
        }

        return json_encode($geojson_format);
    }


    function PetaAksesibilitas($id)
    {

        $data_aksesibilitas = SurveyAksesibilitas::with(['image'])->where('id', (int)$id)->get();

        foreach ($data_aksesibilitas as $d) {
            $value_data = [
                'id' => $d->id,
                'lebar_jalan' => $d->lebar_jalan,
                'jenis_jalan' => $d->jenis_jalan,
                'kelas_jalan' => $d->kelas_jalan,
                'pedestrian' => $d->pedestrian,
                'kelurahan' => $d->kelurahan,
                'kecamatan' => $d->kecamatan,
                'kota' => $d->kota,
                'foto' => $d->image,
            ];

            return response()->json([
                'data' => $value_data,
            ]);
        }
    }


    public function fetchPerkembanganTerbaru($id_data_terbaru)
    {

        // $get_id = Survey::join('users', 'users.id', '=', 'tbl_kondisi_lingkungan.id_user')
        //     ->select('users.*', 'tbl_kondisi_lingkungan.*')
        //     ->orderBy('tbl_kondisi_lingkungan.id', 'Desc')
        //     ->get();

        // $get_perkembangan = SurveyPerkembangan::join('survey', 'tbl_kondisi_lingkungan.id_user', '=', 'survey_perkembangan_wilayah.id_user')
        //     ->select('survey_perkembangan_wilayah.*', 'tbl_kondisi_lingkungan.*')
        //     ->orderBy('tbl_kondisi_lingkungan.id_user', 'Desc')
        //     ->get();

        $data = SurveyPerkembangan::with('user', 'image')->where('id_baru', (int)$id_data_terbaru)->first();

        return response()->json([
            'perkembangan' => $data,
        ]);
    }

    public function slideFoto()
    {

        $slide_foto = SurveyPerkembanganImage::orderBy('id', 'DESC')->take(10)->get();

        return response()->json([
            'slide_foto' => $slide_foto,
        ]);
    }


    public function ExportDetilExcel($data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(25);
            $spreadSheet->getActiveSheet()->fromArray($data);

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];

            $spreadSheet->getActiveSheet()->getStyle('1:1')->applyFromArray($styleArray);

            $spreadSheet->getActiveSheet()->getStyle('B')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('D')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('G')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('I')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadSheet->getActiveSheet()->getStyle('K')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Detil Input Petugas Survey.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function ExportDetilSurvey()
    {

        $data = ViewDetil::select("*")->orderBy('tanggal', 'Desc')->orderBy('petugas', 'Asc')->limit(50000)->get();

        $data_array[] = array("Nama Petugas", "Tanggal Input", "Nama Lokasi", "ID Sub Blok", "Kelurahan", "Kecamatan", "Pola Regional", "Deskripsi Regional", "Pola Lingkungan", "Deskripsi Lingkungan", "Pola Ruang", "Deskripsi Ruang");
        foreach ($data as $data_item) {

            $data_array[] = array(
                'Nama Petugas' => $data_item->petugas,
                'Tanggal Input' => date("d-m-Y", strtotime($data_item->tanggal)),
                'Nama Lokasi' => $data_item->name_tempat,
                'ID Sub Blok' => $data_item->id_sub_blok,
                'Kelurahan' => $data_item->kelurahan,
                'Kecamatan' => $data_item->kecamatan,
                'Pola Regional' => $data_item->regional,
                'Deskripsi Regional' => $data_item->deskripsi_regional,
                'Pola Lingkungan' => $data_item->neighborhood,
                'Deskripsi Lingkungan' => $data_item->deskripsi_neighborhood,
                'Pola Ruang' => $data_item->transect_zone,
                'Deskripsi Ruang' => $data_item->deskripsi_transect_zone
            );
        }
        $this->ExportDetilExcel($data_array);
    }


    function ExportPetugasAksesibilitas()
    {


        $data_aksesibilitas = User::withCount(['harian_aksesibilitas', 'total_aksesibilitas'])->whereHas(
            'kegiatan',
            function ($q) {
                $q->whereHas('kegiatan', function ($q) {
                    $q->where('nama', 'Survey Aksesibilitas');
                });
            }
        )->orderBy('name', 'Asc')->get();


        $data_array[] = array("Nama Petugas AJIB", "Penempatan", "Input Hari Ini", "Input Total");
        foreach ($data_aksesibilitas as $data_item) {
            $data_array[] = array(
                'Nama Petugas AJIB' => $data_item->name,
                'Penempatan' =>  $data_item->penempatan,
                'Input Hari Ini' => (string)$data_item->harian_aksesibilitas_count,
                'Input Total' => (string)$data_item->total_aksesibilitas_count,
            );
        }

        $this->ExportPetugasAksesibilitasExcel($data_array);
    }

    public function ExportPetugasAksesibilitasExcel($data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(25);
            $spreadSheet->getActiveSheet()->fromArray($data);

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];

            $spreadSheet->getActiveSheet()->getStyle('1:1')->applyFromArray($styleArray);

            $spreadSheet->getActiveSheet()->getStyle('C:D')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Kinerja Petugas Survey Aksesibilitas.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function ExportPetugasSurvey()
    {

        $data_kinerja = User::withCount(['perkembangan', 'perkembangan_today'])->with('roles')->whereHas(
            'kegiatan',
            function ($q) {
                $q->whereHas('kegiatan', function ($q) {
                    $q->where('nama', 'Survey Perkembangan Wilayah');
                });
            }
        )->orderBy('name', 'Asc')->get();

        // dd($data_kinerja);

        $data_array[] = array("Nama Petugas AJIB", "Penempatan", "Role", "Input Hari Ini", "Input Total");
        foreach ($data_kinerja as $data_item) {

            $data_array[] = array(
                'Nama Petugas AJIB' => $data_item->name,
                'Penempatan' =>  $data_item->penempatan,
                'Role' =>  $data_item->roles[0]->name,
                'Input Hari Ini' => (string)$data_item->perkembangan_today_count,
                'Input Total' => (string)$data_item->perkembangan_count,
            );
        }
        $this->ExportPetugasExcel($data_array);
    }


    public function ExportPetugasExcel($data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(25);
            $spreadSheet->getActiveSheet()->fromArray($data);

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];

            $spreadSheet->getActiveSheet()->getStyle('1:1')->applyFromArray($styleArray);

            $spreadSheet->getActiveSheet()->getStyle('D:F')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Kinerja Petugas Survey.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    public function ExcelIzinLingkungan($data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(25);
            $spreadSheet->getActiveSheet()->fromArray($data);

            //For Testing
            $no = 0;
            $status = '';

            $count = 2;
            $beforeCount = 2;
            foreach ($data as $d => $val) {
                if ($d == 0) {
                    continue;
                } else {
                    $file = $val['Nama Berkas'];
                    foreach ($file as $f) {
                        $spreadSheet->getActiveSheet()->setCellValue('A' . $count, 'https://jakarta.pintoinvest.com/arsip_file_lingkungan/' . $f->file);
                        $count++;
                    }
                    if (count($file) !== 0) {
                        $count--;
                    }
                    // $count = count($file) - 1;
                    $spreadSheet->getActiveSheet()->mergeCells('B' . $beforeCount . ':B' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('B' . $beforeCount, $val['Wilayah Kewenangan']);
                    $spreadSheet->getActiveSheet()->mergeCells('C' . $beforeCount . ':C' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('C' . $beforeCount, $val['Kewenangan']);
                    $spreadSheet->getActiveSheet()->mergeCells('D' . $beforeCount . ':D' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('D' . $beforeCount, $val['Nomor Permohonan']);
                    $spreadSheet->getActiveSheet()->mergeCells('E' . $beforeCount . ':E' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('E' . $beforeCount, $val['Tipe Pengajuan']);
                    $spreadSheet->getActiveSheet()->mergeCells('F' . $beforeCount . ':F' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('F' . $beforeCount, $val['Tipe Permohonan']);
                    $spreadSheet->getActiveSheet()->mergeCells('G' . $beforeCount . ':G' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('G' . $beforeCount, $val['Kode Izin']);
                    $spreadSheet->getActiveSheet()->mergeCells('H' . $beforeCount . ':H' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('H' . $beforeCount, $val['Nama Izin']);
                    $spreadSheet->getActiveSheet()->mergeCells('I' . $beforeCount . ':I' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('I' . $beforeCount, $val['Nama Penanggung Jawab']);
                    $spreadSheet->getActiveSheet()->mergeCells('J' . $beforeCount . ':J' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('J' . $beforeCount, $val['Nama Perusahaan']);
                    $spreadSheet->getActiveSheet()->mergeCells('K' . $beforeCount . ':K' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('K' . $beforeCount, $val['Alamat Kegiatan Izin']);
                    $spreadSheet->getActiveSheet()->mergeCells('L' . $beforeCount . ':L' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('L' . $beforeCount, $val['Kelurahan']);
                    $spreadSheet->getActiveSheet()->mergeCells('M' . $beforeCount . ':M' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('M' . $beforeCount, $val['Kecamatan']);
                    $spreadSheet->getActiveSheet()->mergeCells('N' . $beforeCount . ':N' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('N' . $beforeCount, $val['Tanggal Pengajuan Izin']);
                    $spreadSheet->getActiveSheet()->mergeCells('O' . $beforeCount . ':O' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('O' . $beforeCount, $val['Status Terakhir']);
                    $spreadSheet->getActiveSheet()->mergeCells('P' . $beforeCount . ':P' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('P' . $beforeCount, $val['Komentar Terakhir']);
                    $spreadSheet->getActiveSheet()->mergeCells('Q' . $beforeCount . ':Q' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('Q' . $beforeCount, $val['Posisi Terakhir']);
                    $spreadSheet->getActiveSheet()->mergeCells('R' . $beforeCount . ':R' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('R' . $beforeCount, $val['Eta Izin']);
                    $spreadSheet->getActiveSheet()->mergeCells('S' . $beforeCount . ':S' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('S' . $beforeCount, $val['Status Waktu Permohonan']);
                    $spreadSheet->getActiveSheet()->mergeCells('T' . $beforeCount . ':T' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('T' . $beforeCount, $val['Lat-Long']);
                    $spreadSheet->getActiveSheet()->mergeCells('U' . $beforeCount . ':U' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('U' . $beforeCount, $val['Status Terbaru']);
                    $spreadSheet->getActiveSheet()->mergeCells('V' . $beforeCount . ':V' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('V' . $beforeCount, $val['Komentar Terbaru']);
                    $spreadSheet->getActiveSheet()->mergeCells('W' . $beforeCount . ':W' . $count);
                    $spreadSheet->getActiveSheet()->setCellValue('W' . $beforeCount, $val['Status']);

                    $no++;
                    $status = $beforeCount > $count ? 'Salah' : 'Benar';
                    // echo "$no . $beforeCount,$count - $status - " . count($file) . " - " . $val['Nomor Permohonan'] . "<br>";
                    if (count($file) >= 1) {
                        $count++;
                        $beforeCount = $count;
                    } elseif (count($file) == 0) {
                        $count++;
                        $beforeCount = $count;
                    }
                }
            }


            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];

            $spreadSheet->getActiveSheet()->getStyle('1:1')->applyFromArray($styleArray);

            $spreadSheet->getActiveSheet()->getStyle('B:X')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $spreadSheet->getActiveSheet()->getStyle('B:X')
                ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // $spreadSheet->getActiveSheet()->mergeCells('A1:A2');

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Izin Lingkungan.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function ExportIzinLingkungan()
    {

        $data_lingkungan = IzinLingkungan::with('arsip_file')->get();

        $data_array[] = array("Nama Berkas", "Wilayah Kewenangan", "Kewenangan", "Nomor Permohonan", "Tipe Pengajuan", "Tipe Permohonan", "Kode Izin", "Nama Izin", "Nama Penanggung Jawab", "Nama Perusahaan", "Alamat Kegiatan Izin", "Kelurahan", "Kecamatan", "Tanggal Pengajuan Izin", "Status Terakhir", "Komentar Terakhir", "Posisi Terakhir", "Eta Izin", "Status Waktu Permohonan", "Lat-Long", "Status Terbaru", "Komentar Terbaru", "Status");
        foreach ($data_lingkungan as $data) {

            if ($data->status == '1') {
                $status = 'Berkas Sudah Terbit';
            } elseif ($data->status == '2') {
                $status = 'Berkas Sudah Ditolak';
            } elseif ($data->status == '3') {
                $status =  'Berkas Sudah Dibatalkan Sistem';
            } elseif ($data->status == '4') {
                $status =  'Berkas Sedang Diproses oleh Wilayah';
            } elseif ($data->status == '5') {
                $status = 'Berkas Perlu Disposisi Pimpinan';
            }

            $data_array[] = array(
                'Nama Berkas' => $data->arsip_file,
                'Wilayah Kewenangan' => $data->wilayah_kewenangan,
                'Kewenangan' =>  $data->up_kewenangan,
                'Nomor Permohonan' =>  (string)$data->nomor_permohonan,
                'Tipe Pengajuan' => $data->tipe_pengajuan,
                'Tipe Permohonan' => $data->tipe_permohonan,
                'Kode Izin' => $data->kode_izin,
                'Nama Izin' => $data->nama_izin,
                'Nama Penanggung Jawab' => $data->nama_penanggung_jawab,
                'Nama Perusahaan' => $data->nama_perusahaan,
                'Alamat Kegiatan Izin' => $data->alamat_kegiatan_izin,
                'Kelurahan' => $data->kelurahan_kegiatan,
                'Kecamatan' => $data->kecamatan_kegiatan,
                'Tanggal Pengajuan Izin' => date("d-m-Y", strtotime($data->tanggal_pengajuan_izin)),
                'Status Terakhir' => $data->status_terakhir,
                'Komentar Terakhir' => $data->komentar_terakhir,
                'Posisi Terakhir' => $data->posisi_terakhir,
                'Eta Izin' => $data->eta_izin,
                'Status Waktu Permohonan' => $data->status_waktu_permohonan,
                'Lat-Long' => $data->lat . ',' . $data->long,
                'Status Terbaru' => $data->status_terbaru,
                'Komentar Terbaru' => $data->komentar_terbaru,
                'Status' => $status
            );
        }
        $this->ExcelIzinLingkungan($data_array);
    }




    public  function userRegistrasi()
    {
        $data =
            User::select(['id', 'name', 'email', 'jabatan', 'penempatan', 'sektor', 'allowed', 'id_status_pegawai'])->with('roles', 'kegiatan.kegiatan')->get();

        return Datatables::of($data)->addColumn('aksi', function (User $row) {
            $role = isset($row->roles[0]->name) ? $row->roles[0]->name : '-';
            $btn = '<div class="row row-cards">
                        <div class="col-md-6 col-xl-6">
                        <a class="btn btn-tabler w-100 btn-icon" aria-label="Google" data-bs-toggle="modal" data-bs-target="#modalEditUsers"
                        onclick="editPegawai(' . $row->id . ',\'' . $row->name . '\',\'' . $row->email . '\',\'' . $row->penempatan . '\',\'' . base64_encode($row->kegiatan) . '\',\'' . $role . '\',\'' . $row->jabatan . '\',\'' . base64_encode($row->sektor) . '\',\'' . $row->allowed . '\',\'' . $row->id_status_pegawai . '\')"><i class="fa fa-edit"></i></a></div>';
            $csrf = csrf_field();

            $deletee = '<input type="hidden" name="_method" value="DELETE">';

            $btn .= '<div class="col-md-6 col-xl-6">
                        <form action="/v1/dashboard/register" class="d-inline" method="POST">
                        ' . $csrf . $deletee . '
                        <button type="submit" class="btn btn-google w-100 btn-icon" aria-label="Tabler">
                        <i class="fa fa-trash"></i>
                        </button>
                        <input type="hidden" name="id" value="' . $row->id . '">
                        </div>
                        </div>';
            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    // get data aktivitas login
    public  function getAktivitasLogin()
    {
        $data_login_user = LogingAuth::with('user')->orderBy('time', 'DESC')->get();

        return Datatables::of($data_login_user)
            ->editColumn('time', function ($data) {
                return date('Y-m-d H:i:s', strtotime($data->time));
            })
            ->make(true);
    }

    public function aksesibilitas()
    {

        // Hitung Titik Tercatat Hari Ini
        $get_tgl_perhari = date('Y-m-d');
        $survey_aksesibilitas_perhari = SurveyAksesibilitas::whereDate('created_at', $get_tgl_perhari)->get()->count();

        // Total Titik Tercatat
        $hitung_survey_aksesibilitas = SurveyAksesibilitas::get()->count();


        // Data
        $data_aksesibilitas = SurveyAksesibilitas::with(['image'])->orderBy('id', 'desc')->get();

        $kelurahan = SurveyAksesibilitas::orderBy('kelurahan', 'DESC')->get()->whereNotNull('kelurahan')->groupBy('kelurahan');

        return view('admin.survey.aksesibilitas', compact(['data_aksesibilitas', 'survey_aksesibilitas_perhari', 'hitung_survey_aksesibilitas', 'kelurahan']));
    }

    public function pengawasan_dua(Request $request)
    {

        $hasil_jumlah_titik = PinLocation::all()->count();

        // $get_tgl_perhari = date('Y-m-d');
        // $get_pengawasan_day = PinLocation::Where('date', $get_tgl_perhari)->get();

        $get_tgl_perhari = date('Y-m-d');
        $get_pengawasan_day = PinLocation::whereRaw("date(date) = ?", [$get_tgl_perhari])->get();

        // dd($get_pengawasan_day);

        $count_pengawasan = User::with(['roles', 'kegiatan'])->whereHas('kegiatan', function ($q) {
            $q->whereHas('kegiatan', function ($q) {
                $q->where('nama', 'Pengawasan Tahap 2');
            });
        })->orWhereHas(
            'roles',
            function ($q) {
                $q->where('name', 'super');
                $q->orWhere('name', 'super admin');
            }
        )->get();

        $slider_pengawasandua = PinLocation::with('image')->orderBy('id', 'DESC')->take(100)->get();

        $kelurahan = PinLocation::orderBy('kelurahan', 'DESC')->get()->whereNotNull('kelurahan')->groupBy('kelurahan');


        return view('admin.survey.pengawasan_dua', compact(['count_pengawasan', 'get_pengawasan_day', 'hasil_jumlah_titik', 'slider_pengawasandua', 'kelurahan']));
    }

    public function dataPengawasanDua()
    {
        $data_pengawasan = PinLocation::with(['image', 'user'])->orderBy('id', 'DESC')->limit(1)->get();
        return response()->json([
            'data_pengawasan' => $data_pengawasan,
        ]);
    }

    public function GetDataPengawasan(Request $request)
    {

        // $data_pengawasan = PinLocation::with(['image', 'user'])->orderBy('id', 'DESC')->limit(1)->get();
        // $data_pengawasan = PinLocation::with(['image', 'user'])->orderBy('id', 'DESC')->get();

        // dd($data_pengawasan->user[0]);

        if ($request->ajax()) {
            // $data_pengawasan = PinLocation::with(['image', 'user'])->orderBy('id', 'DESC')->limit(1)->get();
            $data_pengawasan = PinLocation::with(['image', 'user'])->orderBy('id', 'DESC')->get();

            // dd($data_pengawasan[0]->image[0]->name);
            // dd(count($data_pengawasan[0]->image));


            return Datatables::of($data_pengawasan)
                ->editColumn('foto', function ($data_pengawasan) {
                    // dd(count($data_pengawasan->image));
                    if (count($data_pengawasan->image) == 0) {
                        return '<img src="https://jakarta.pintoinvest.com/survey/not_image.png" width="100%" height="110px" />';
                    } else {
                        return '<img src="/publik/favorit/' . $data_pengawasan->image[0]->name . '" width="100%" height="110px" />';
                    }
                })
                ->rawColumns(['foto'])
                ->make(true);
        }
    }

    public function GetSliderPengawasan($id)
    {

        $data_pengawasan = PinLocation::with(['image', 'user'])->where('id', (int)$id)->first();

        return response()->json([
            'data_pengawasan' => $data_pengawasan,
        ]);
    }

    // get data pengawasan

    public function pdf_pengawasandua($kelurahan = null)
    {

        if ($kelurahan !== null) {
            $data = PinLocation::with(['image', 'user'])->where('kelurahan', $kelurahan)->get();
        } else {
            $data = PinLocation::with(['image', 'user'])->get();
        }

        $opciones_ssl = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                'allow_self_signed' => TRUE,
            ),
        );

        // dd($data);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->setPaper('portrait');
        $pdf->getDomPDF()->setHttpContext(stream_context_create($opciones_ssl));
        $pdf->loadView('admin.pdf_pengawasan_dua', compact('data'));

        return $pdf->stream();
    }

    public function petaPengawasan()
    {
        $geojson_format = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        // if (Auth::user()->hasRole('admin')) {
        //     $data = PinLocation::all();
        // } else {
        //     $data = PinLocation::where('id_user', Auth::user()->id)->get();
        // }

        $data = PinLocation::with('image')->get();

        // dd($data);

        foreach ($data as $d) {

            $coor = explode(",", $d->kordinat);
            $value_data = [
                'type' => "Feature",
                'properties' => [
                    'id' => $d->id,
                    'judul' => $d->judul,
                    'catatan' => $d->catatan,
                    'kelurahan' => $d->kelurahan,
                    'tipe' => $d->tipe,
                    'nameimage' => count($d->image) == 0 ? 'not_image.png' : $d->image[0]->name,
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$coor[1], $coor[0]]
                ]
            ];

            // dd($value_data);

            array_push($geojson_format['features'], $value_data);
        }

        // dd($geojson_format);

        return json_encode($geojson_format, true);
    }


    function petaPengawasanID($id)
    {

        $data = PinLocation::with('image')
            ->where('id', $id)
            ->get();

        foreach ($data as $d) {
            $value_data = [
                'id' => $d->id,
                'judul' => $d->judul,
                'kordinat' => $d->kordinat,
                'catatan' => $d->catatan,
                'kelurahan' => $d->kelurahan,
                'tipe' => $d->tipe,
                'foto' => $d->image
            ];


            return response()->json([
                'data' => $value_data,
            ]);
        }
    }

    function ExportPengawasanDua()
    {

        $data_pengawasan = User::with(['roles', 'kegiatan'])->whereHas('kegiatan', function ($q) {
            $q->whereHas('kegiatan', function ($q) {
                $q->where('nama', 'Pengawasan Tahap 2');
            });
        })->orWhereHas(
            'roles',
            function ($q) {
                $q->where('name', 'super');
                $q->orWhere('name', 'super admin');
            }
        )->get();


        // dd($data_pengawasan);

        $data_array[] = array("Nama", "Penempatan", "Role");
        foreach ($data_pengawasan as $data_item) {

            $data_array[] = array(
                'Nama Petugas AJIB' => $data_item->name,
                'Penempatan' =>  $data_item->penempatan,
                'Role' =>   isset($data_item->roles[0]->name) ? $data_item->roles[0]->name : '-',
            );
        }
        $this->ExportPengawasanDuaExcel($data_array);
    }


    public function ExportPengawasanDuaExcel($data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(25);
            $spreadSheet->getActiveSheet()->fromArray($data);

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];

            $spreadSheet->getActiveSheet()->getStyle('1:1')->applyFromArray($styleArray);

            $spreadSheet->getActiveSheet()->getStyle('C:F')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Data Admin Pengawasan Dua.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}


// HITUNG JUMLAH PETUGAS AJIB YANG MELAKUKAN PENGAWASAN TAHAP 2
// $count_pengawasan = User::with(['roles', 'kegiatan'])->whereHas('kegiatan', function ($q) {
//     $q->whereHas('kegiatan', function ($q) {
//         $q->where('nama', 'Pengawasan Tahap 2');
//     });
// })->orWhereHas(
//     'roles',
//     function ($q) {
//         $q->whereIn('name', ['admin', 'super admin', 'ajib-kecamatan', 'ajib-kelurahan']);
//     }
// )->get();