<?php

namespace App\Http\Controllers;

use App\Models\ImagePendataanUsaha;
use Illuminate\Http\Request;
use App\Models\PendataanUsaha;
use App\Models\ServerChat;
use App\Models\TicketingUsaha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\User;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;


class PendataanUsahaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Pendataan Usaha');
    }

    public function savePendataanUsaha(Request $request)
    {
        $data = $request->all();
        if ($data['id'] == '') {
            PendataanUsaha::create($request->all());
            if ($request->hasFile('foto')) {
                $last_id = PendataanUsaha::orderBy('id', 'desc')->first();
                $file = $request->file('foto');
                foreach ($file as $f) {
                    $name = $name = rand(0, 9999999999) . strtotime(date('Y-m-d H:i:s')) . ".jpg";
                    $f->move(public_path() . '/usaha/', $name);
                    $data['foto'] = $name;
                    $data['id_survey'] = $last_id->id;
                    $data['name'] = $name;
                    ImagePendataanUsaha::create($data);
                }
            }
        } else {
            $pendataanUsaha = PendataanUsaha::find($data['id']);
            $pendataanUsaha->update($request->all());
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                foreach ($file as $f) {
                    $name = $name = rand(0, 9999999999) . strtotime(date('Y-m-d H:i:s')) . ".jpg";
                    $f->move(public_path() . '/usaha/', $name);
                    $data['foto'] = $name;
                    $data['id_survey'] = $data['id'];
                    $data['name'] = $name;
                    ImagePendataanUsaha::create($data);
                }
            }
        }
    }

    public function getPendataanUsaha()
    {
        $pendataanUsaha = PendataanUsaha::with('image')->where('id_user', Auth::user()->id)->get();
        return response()->json($pendataanUsaha);
    }

    public function getPendataanUsahaById($id)
    {
        $pendataanUsaha = PendataanUsaha::with('image')->find($id);
        return response()->json($pendataanUsaha);
    }

    public function deletePendataanUsaha(Request $request)
    {
        $pendataanUsaha = PendataanUsaha::with('image')->find((int)$request->id);
        if (count($pendataanUsaha->image) != 0) {
            foreach ($pendataanUsaha->image as $img) {
                unlink(public_path() . '/usaha/' . $img->name);
                $data_image = ImagePendataanUsaha::find($img->id);
                $data_image->delete();
            }
        }
        $pendataanUsaha->delete();
    }

    public function printUsahaExcel()
    {
        $data = PendataanUsaha::where('id_user', Auth::user()->id)->get();
        return view('print-usaha', compact('data'));
    }

    public function deleteImageUsaha(Request $request)
    {
        $image = ImagePendataanUsaha::find($request->id);
        unlink(public_path() . '/usaha/' . $image->name);
        $image->delete();
    }


    // Admin Pendataan
    public function PendataanUsaha()
    {
        $slider_pendataan = PendataanUsaha::with('image')->get();
        $total_tercatat_pendataan = PendataanUsaha::get();
        $akses_pendataan_usaha = PendataanUsaha::select('id_user')->groupBy('id_user')->get();
        $get_tgl_perhari = date('Y-m-d');
        $get_pendataan_perhari = PendataanUsaha::Where('tgl', $get_tgl_perhari)->get();

        $jml_pendataan = PendataanUsaha::all()->count();
        $progres_total = $jml_pendataan / 22 * 100;
        $get_total_pendataan = number_format((float)$progres_total, 2, '.', '');

        return view('admin.pendataan.pendataan_usaha', compact(['get_pendataan_perhari', 'get_total_pendataan', 'akses_pendataan_usaha', 'slider_pendataan', 'total_tercatat_pendataan']));
    }


    public function GetPendataanSlider($id)
    {

        $data_slider = PendataanUsaha::with('image', 'user')->where('id', (int)$id)->first();

        return response()->json([
            'data_slider_pendataan_usaha' => $data_slider,
        ]);
    }

    public function GetDataPendataanUsaha()
    {
        // $pendataan_usaha = PendataanUsaha::with('image')->orderBy('id', 'DESC')->limit(1)->get();
        $pendataan_usaha = PendataanUsaha::with('image', 'user')->orderBy('id', 'ASC')->limit(1)->get();

        // dd($pendataan_usaha);

        return response()->json([
            'data_usaha' => $pendataan_usaha,
        ]);
    }


    public  function PetugasPendataan()
    {
        $data_petugas_pendataan = User::withCount(['input_pendataa_perhari', 'pendataan'])->with('roles')->whereHas(
            'kegiatan',
            function ($q) {
                $q->whereHas('kegiatan', function ($q) {
                    $q->where('nama', 'Pendataan Usaha');
                });
            }
        )->get();


        return Datatables::of($data_petugas_pendataan)
            ->editColumn('roles', function ($data) {
                $role = isset($data->roles[0]->name) ? $data->roles[0]->name : '-';
                return "$role";
            })
            ->rawColumns(['roles'])->make(true);
    }

    public  function getDetilPendataan()
    {;
        $total_tercatat_pendataan = PendataanUsaha::with('user')->get();

        return Datatables::of($total_tercatat_pendataan)
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

            ->rawColumns(['kelurahan', 'kecamatan'])->make(true);

        // dd($data);
    }

    // Peta
    public function titikPendataanUsaha()
    {
        $geojson_format = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        $data = PendataanUsaha::with('image')->get();

        foreach ($data as $d) {
            $coor = explode(",", $d->kordinat);
            $value_data = [
                'type' => "Feature",
                'properties' => [
                    'id' => $d->id,

                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$coor[1], $coor[0]]
                ]
            ];

            // dd($value_data);

            array_push($geojson_format['features'], $value_data);
        }

        return json_encode($geojson_format, true);
    }

    // Peta
    function petaPendataan($id)
    {

        $data = PendataanUsaha::with('image')->where('id', (int)$id)->get();

        // dd($data);

        foreach ($data as $d) {
            $val_map_pendataan = [
                'id' => $d->id,
                // 'image' => $d->image[0]->name,
                'nameimage' => $d->image,
                'no_perjanjian' => $d->no_perjanjian,
                'pelaku' => $d->pelaku,
                'nama_usaha' => $d->nama_usaha,
                'sektor' => $d->sektor,
                'modal' => $d->modal,
                'jumlah_tenaga' => $d->jumlah_tenaga,
                'id_sub_blok' => $d->id_sub_blok,
                'kelurahan' => $d->kelurahan,
                'kecamatan' => $d->kecamatan,
                'id' => $d->badan_usaha
            ];

            // dd($val_map_pendataan);

            return response()->json([
                'data' => $val_map_pendataan,
            ]);
        }
    }

    // Chating Pendataan Usaha

    public function ChatingPendataanUsaha()
    {
        $server_chat = ServerChat::with('kategori.chanel')->orderBy('id', 'ASC')->get();

        return view('chating.pendataan_usaha_new', compact('server_chat'));
    }

    public function save_ticket(Request $request)
    {
        try {
            $last_id = TicketingUsaha::orderBy('id', 'DESC')->count();
            TicketingUsaha::create([
                'id_user' => Auth::user()->id,
                'penanggung_jawab' => $request->penanggung_jawab,
                'sektor' => $request->sektor,
                'terkait' => $request->terkait,
                'lampiran' => $request->file('lampiran')->getClientOriginalName(),
                'deskripsi' => $request->deskripsi,
                'no_ticket' => sprintf('%05d', $last_id + 1),
            ]);
            $request->file('lampiran')->move(public_path('ticketing_usaha'), $request->file('lampiran')->getClientOriginalName());
            return response()->json([
                'status' => 'success',
                'message' => 'Ticketing berhasil ditambahkan',
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ticketing gagal ditambahkan',
            ], 500);
        }
    }

    public function uploadFileChat(Request $request)
    {
        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        try {
            $file->move(public_path('file_chat'), $nama_file);
            return response()->json([
                'status' => 'success',
                'message' => 'File berhasil diupload',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'File gagal diupload',
            ], 500);
        }
    }

    public function downloadFileChat($nama_file)
    {
        $file_path = public_path('file_chat/' . $nama_file);
        return response()->download($file_path);
    }


    function ExportDetilPendataan()
    {

        $data_petugas_pendataan = PendataanUsaha::with('user')->get();

        // dd($data_petugas_pendataan);

        $data_array[] = array("Nama Petugas AJIB", "No Perjanjian", "Pelaku", "Nama Usaha", "Sektor", "Modal", "Jumlah Tenaga", "Alamat", "ID Sub Blok", "Kelurahan", "Kecamatan", "Badan Usaha");
        foreach ($data_petugas_pendataan as $data_item) {



            $data_array[] = array(

                'Nama Petugas AJIB' => $data_item->user->name,
                'No Perjanjian' =>  (string)$data_item->no_perjanjian,
                'Pelaku' =>  $data_item->pelaku,
                'Nama Usaha' =>  $data_item->nama_usaha,
                'Sektor' =>  $data_item->sektor,
                'Modal' =>  $data_item->modal,
                'Jumlah Tenaga' =>  $data_item->jumlah_tenaga,
                'Alamat' =>  $data_item->alamat,
                'ID Sub Blok' =>  $data_item->id_sub_blok,
                'Kelurahan' =>  $data_item->kelurahan,
                'Kecamatan' =>  $data_item->kecamatan,
                'Badan Usaha' =>  $data_item->badan_usaha,
            );
        }
        $this->ExportDetilPendataanExcel($data_array);
    }


    public function ExportDetilPendataanExcel($data)
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

            $spreadSheet->getActiveSheet()->getStyle('F:G')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $spreadSheet->getActiveSheet()->getStyle('I')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Detil Input Pendataan.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }


    function ExportPetugasPendataan()
    {

        $data_petugas_pendataan = User::withCount(['pendataan', 'input_pendataa_perhari'])->with('roles')->whereHas(
            'kegiatan',
            function ($q) {
                $q->whereHas('kegiatan', function ($q) {
                    $q->where('nama', 'Pendataan Usaha');
                });
            }
        )->orderBy('name', 'Asc')->get();


        // dd($data_petugas_pendataan);

        $data_array[] = array("Nama Petugas AJIB", "Penempatan", "Role", "Input Hari Ini", "Input Total");
        foreach ($data_petugas_pendataan as $data_item) {

            $data_array[] = array(
                'Nama Petugas AJIB' => $data_item->name,
                'Penempatan' =>  $data_item->penempatan,
                'Role' =>   isset($data_item->roles[0]->name) ? $data_item->roles[0]->name : '-',
                'Input Total' => (string)$data_item->pendataan_count,
                'Input Hari Ini' => (string)$data_item->input_pendataa_perhari_count
            );
        }
        $this->ExportPetugasPendataanExcel($data_array);
    }


    public function ExportPetugasPendataanExcel($data)
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
            header('Content-Disposition: attachment;filename="Kinerja Petugas Pendataan.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
}
