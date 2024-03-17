<?php

namespace App\Http\Controllers;

use App\Models\ArsipFileIzinLingkugan;
use App\Models\ArsipIzinLingkugan;
use App\Models\IzinLingkungan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\KajianLingkungan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KajianLingkunganController extends Controller
{
    public function save_kajian(Request $request)
    {
        $id_user = Auth::user()->id;
        $judul = $request->input('judul');
        $opini = $request->input('opini');
        $wilayah = session('wilayah_kajian') !== null ? json_encode(session('wilayah_kajian')) : null;
        $kordinat = session('kordinat_kajian') !== null ? json_encode(session('kordinat_kajian')) : null;
        $njop = session('njop_kajian') !== null ? json_encode(session('njop_kajian')) : null;
        $bpn = session('bpn_kajian') !== null ? json_encode(session('bpn_kajian')) : null;
        $air_tanah = session('air_tanah_kajian') !== null ? json_encode(session('air_tanah_kajian')) : null;
        $zona = session('zoning_kajian') !== null ? json_encode(session('zoning_kajian')) : null;
        $ketentuan_tpz = session('ketentuan_tpz_kajian') !== null ? json_encode(session('ketentuan_tpz_kajian')) : null;
        $ketentuan_khusus = session('ketentuan_khusus_kajian') !== null ? json_encode(session('ketentuan_khusus_kajian')) : null;
        $poi = session('poi_kajian') !== null ? json_encode(session('poi_kajian')) : null;
        $kbli = session('kbli_kajian') !== null ? json_encode(session('kbli_kajian')) : null;
        $param_kbli = session('param_kbli_kajian') !== null ? json_encode(session('param_kbli_kajian')) : null;
        $itbx = session('itbx_kajian') !== null ? json_encode(session('itbx_kajian')) : null;
        $peta = session('img_kajian');
        $chart_pie = session('chart_pie_kajian');
        $chart_bar = session('chart_bar_kajian');

        if ($wilayah == null) {
            return response()->json(['error' => 'Pilih Wilayah Terlebih Dahulu'], 500);
        }

        KajianLingkungan::create([
            'id_user' => $id_user,
            'judul' => $judul,
            'opini' => $opini,
            "wilayah" => $wilayah,
            "kordinat" => $kordinat,
            "njop" => $njop,
            "bpn" => $bpn,
            "air_tanah" => $air_tanah,
            "zona" => $zona,
            "ketentuan_tpz" => $ketentuan_tpz,
            "ketentuan_khusus" => $ketentuan_khusus,
            "poi" => $poi,
            "kbli" => $kbli,
            "param_kbli" => $param_kbli,
            "itbx" => $itbx,
            "peta" => $peta,
            "chart_pie" => $chart_pie,
            "chart_bar" => $chart_bar,
        ]);

        $request->session()->forget(['wilayah_kajian', 'kordinat_kajian', 'njop_kajian', 'bpn_kajian', 'air_tanah_kajian', 'zoning_kajian', 'ketentuan_tpz_kajian', 'ketentuan_khusus_kajian', 'poi_kajian', 'kbli_kajian', 'param_kbli_kajian', 'itbx_kajian', 'img_kajian', 'chart_pie_kajian', 'chart_bar_kajian']);

        return response()->json(['success' => 'Data berhasil disimpan'], 200);
    }

    public function get_kajian()
    {
        $id_user = Auth::user()->id;
        $kajian = DB::connection('pgsql')->select("SELECT judul, opini, json_build_object('lat', (kordinat::json->>0)::NUMERIC, 'lng', (kordinat::json->>1)::NUMERIC)::json as kordinat, param_kbli, itbx::json->>0 as itbx, ketentuan_khusus::json->>0 as ketentuan_khusus, wilayah::jsonb->>'Kelurahan' as kelurahan FROM survey.tbl_kajian_lingkungan WHERE id_user = $id_user ORDER BY id DESC");

        return response()->json(['data' => $kajian], 200);
    }


    public function search_izin(Request $request)
    {
        $keyword = $request->input('keyword');
        $izin = IzinLingkungan::with('arsip_file')->where('nomor_permohonan', 'like', '%' . $keyword . '%')->get();

        return response()->json(['data' => $izin], 200);
    }

    public function save_arsip_izin(Request $request)
    {
        $status = 0;
        $kordinat = explode(',', $request->input('koordinat'));
        $status_terbaru = $request->input('status_terbaru');
        if ($status_terbaru == 'Berkas Sudah Terbit') {
            $status = 1;
        } elseif ($status_terbaru == 'Berkas Sudah Ditolak') {
            $status = 2;
        } elseif ($status_terbaru == 'Berkas Sudah Dibatalkan Sistem') {
            $status = 3;
        } elseif ($status_terbaru == 'Berkas Sedang Diproses oleh Wilayah') {
            $status = 4;
        } elseif ($status_terbaru == 'Berkas Perlu Disposisi Pimpinan') {
            $status = 5;
        }

        $arsip =  IzinLingkungan::with('arsip_file')->where('nomor_permohonan', $request->input('nomor_permohonan'))->first();

        if ($status == 5) {
            $jumlah_arsip = $arsip->arsip_file == null ? 0 : count($arsip->arsip_file);
            $upload_arsip = $request->file('file') == null ? 0 : count($request->file('file'));
            $keseluruhan = $upload_arsip + $jumlah_arsip;
            if ($keseluruhan < 2) {
                return response()->json(['message' => 'Upload Arsip Minimal 2'], 500);
            } else {
                IzinLingkungan::where('nomor_permohonan', $request->input('nomor_permohonan'))->update([
                    'status_terbaru' => $request->input('status_terbaru'),
                    'komentar_terbaru' => $request->input('komentar_terbaru'),
                    'id_user' => Auth::user()->id,
                    'status' => $status,
                    'lat' => (float)$kordinat[0],
                    'long' => (float)$kordinat[1],
                    'update_time' => date('Y-m-d')
                ]);

                if ($request->hasFile('file')) {
                    foreach ($request->file('file') as $f) {
                        $fileName = $f->getClientOriginalName();
                        $f->move(public_path('arsip_izin_lingkungan'), $fileName);
                        ArsipFileIzinLingkugan::create([
                            'nomor_permohonan' => $request->input('nomor_permohonan'),
                            'file' => $fileName,
                        ]);
                    }
                }

                $data = ArsipFileIzinLingkugan::where('nomor_permohonan', $request->input('nomor_permohonan'))->get();

                return response()->json(['message' => 'Data berhasil disimpan', 'data' => $data], 200);
            }
        } else {
            IzinLingkungan::where('nomor_permohonan', $request->input('nomor_permohonan'))->update([
                'status_terbaru' => $request->input('status_terbaru'),
                'komentar_terbaru' => $request->input('komentar_terbaru'),
                'id_user' => Auth::user()->id,
                'status' => $status,
                'lat' => (float)$kordinat[0],
                'long' => (float)$kordinat[1],
                'update_time' => date('Y-m-d')
            ]);

            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $f) {
                    $fileName = $f->getClientOriginalName();
                    $f->move(public_path('arsip_izin_lingkungan'), $fileName);
                    ArsipFileIzinLingkugan::create([
                        'nomor_permohonan' => $request->input('nomor_permohonan'),
                        'file' => $fileName,
                    ]);
                }
            }

            $data = ArsipFileIzinLingkugan::where('nomor_permohonan', $request->input('nomor_permohonan'))->get();

            return response()->json(['message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
    }

    public function get_data_izin()
    {
        $id_user = Auth::user()->id;
        $data = IzinLingkungan::with('arsip_file')->where('id_user', $id_user)->orderBy('update_time', 'desc')->get();

        return response()->json(['data' => $data], 200);
    }

    public function delete_arsip(Request $request)
    {
        $id = $request->input('id');
        $file = ArsipFileIzinLingkugan::find($id);
        unlink(public_path('arsip_izin_lingkungan/' . $file->file));
        $file->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

    public function list_kelurahan()
    {
        $data = IzinLingkungan::select('kelurahan_kegiatan')->distinct()->orderBy('kelurahan_kegiatan', 'ASC')->get();

        return response()->json(['data' => $data], 200);
    }

    public function list_nama_izin($kelurahan)
    {
        $data = IzinLingkungan::select('nama_izin')->distinct()->where('kelurahan_kegiatan', $kelurahan)->orderBy('nama_izin', 'ASC')->get();

        return response()->json(['data' => $data], 200);
    }

    public function list_nomor_permohonan($kelurahan, $nama_izin)
    {
        $data = IzinLingkungan::with('arsip_file')->where('kelurahan_kegiatan', $kelurahan)->where('nama_izin', $nama_izin)->orderBy('nomor_permohonan', 'ASC')->get();

        return response()->json(['data' => $data], 200);
    }

    public function layer_izin_lingkungan()
    {
        $geojson_format = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        $data = IzinLingkungan::all();

        foreach ($data as $d) {
            $value_data = [
                'type' => "Feature",
                'properties' => [
                    'wilayah_kewenangan' => $d->wilayah_kewenangan,
                    'up_kewenangan' => $d->up_kewenangan,
                    'nomor_permohonan' => $d->nomor_permohonan,
                    'tipe_pengajuan' => $d->tipe_pengajuan,
                    'tipe_permohonan' => $d->tipe_permohonan,
                    'kode_izin' => $d->kode_izin,
                    'nama_izin' => $d->nama_izin,
                    'alamat_kegiatan_izin' => $d->alamat_kegiatan_izin,
                    'kelurahan_kegiatan' => $d->kelurahan_kegiatan,
                    'kecamatan_kegiatan' => $d->kecamatan_kegiatan,
                    'tanggal_pengajuan_izin' => $d->tanggal_pengajuan_izin,
                    'status_terakhir' => $d->status_terakhir,
                    'posisi_terakhir' => $d->posisi_terakhir,
                    'komentar_terakhir' => $d->komentar_terakhir,
                    'eta_izin' => $d->eta_izin,
                    'status_waktu_permohonan' => $d->status_waktu_permohonan,
                    'status_terbaru' => $d->status_terbaru,
                    'komentar_terbaru' => $d->komentar_terbaru,
                    'status' => $d->status,
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float)$d->long, (float)$d->lat]
                ]
            ];

            array_push($geojson_format['features'], $value_data);
        }

        return response()->json($geojson_format, 200);
    }
}
