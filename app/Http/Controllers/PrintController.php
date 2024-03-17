<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use DocxMerge\DocxMerge;

class PrintController extends Controller
{
    protected $url_api = "https://jakarta.pintoinvest.com:3444";
    protected $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MTE0Mzk5OTIsIm5hbWUiOiJhZG1pbiJ9.q0dE4itQi0sJQ3-qABWZyYjYGTx5PRrLTH-tOZ6pTs8";
    public $list_session = ['profil', 'akses', 'indikator', 'lingkungan', 'kbli', 'potensi', 'ketentuan'];
    protected $radius = 1000;
    protected $coordinates = [];
    protected $image_map;

    public function print(Request $request)
    {
        // return phpinfo();
        // dd(json_decode(base64_decode($request->ketentuan_properties), 1)['ketentuan_tpz']);
        // list checked katagori
        $kategori = $request->kategori;

        // Replace Radius
        $this->radius = $request->radius;
        $radius = $this->radius;

        // Replace Coordinates
        $this->coordinates = explode(",", $request->coordinates_print);
        $coordinates = $this->coordinates;

        // Replace Image Map
        $this->image_map = $request->image_map;
        $image_map = $this->image_map;

        $data_printed = [];

        // List Lampiran
        $lampiran = [];

        array_push($data_printed, 'kategori', 'radius', 'coordinates', 'image_map');

        if (in_array("profil", $kategori)) {
            $wilayah = $this->get_wilayah();
            $eksisting = $this->get_eksisting();
            $njop = $this->get_njop();
            $rerata_njop = $this->get_rerata_njop($wilayah['Kelurahan']);
            $bpn = $this->get_bpn();
            $distribusi_wilayah = $this->get_distribusi_wilayah($wilayah['Kelurahan']);
            $distribusi_nib = $this->get_distribusi_nib($wilayah['Kelurahan']);

            array_push($data_printed, 'wilayah', 'eksisting', 'njop', 'bpn', 'distribusi_wilayah', 'distribusi_nib', 'rerata_njop');
        }
        if (in_array("akses", $kategori)) {
            $poi = $this->get_poi();

            array_push($data_printed, 'poi');
        }
        if (in_array("indikator", $kategori)) {
            $urban = $this->get_urban_index();
            $ddl = $this->get_ddl_index();
            $livability = $this->get_livability_index();

            array_push($data_printed, 'urban', 'ddl', 'livability');
        }
        if (in_array("kbli", $kategori)) {
            $kbli = json_decode(base64_decode($request->kbli_properties), 1);

            array_push($data_printed, 'kbli');
        }
        if (in_array("lingkungan", $kategori)) {
            $lingkungan = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', base64_decode($request->lingkungan_properties)), 1);

            array_push($data_printed, 'lingkungan');
        }

        if (in_array("potensi", $kategori)) {
            $potensi = json_decode(base64_decode($request->potensi_properties), 1);

            array_push($data_printed, 'potensi');
        }

        if (in_array("ketentuan", $kategori)) {
            $ketentuan = json_decode(base64_decode($request->ketentuan_properties), 1);

            if (isset($ketentuan['ketentuan_tpz'])) {
                foreach ($ketentuan['ketentuan_tpz'] as $ktpz) {
                    foreach ($ktpz as $key => $value) {
                        if ($key == "List_File") {
                            array_push($lampiran, $value);
                        }
                    }
                }
            }

            array_push($data_printed, 'ketentuan');
        }

        // response
        $response = null;

        if ($request->format == "pdf") {
            $opciones_ssl = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    'allow_self_signed' => TRUE,
                ),
            );
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled', true]);
            $pdf->setPaper('portrait');
            $pdf->getDomPDF()->setHttpContext(stream_context_create($opciones_ssl));
            $pdf->loadView('print', compact($data_printed));

            // Save Pdf
            $random_string_origin = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
            $random_string_merger = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
            $filePdforigin = public_path('pdf_file/' . $random_string_origin . '.pdf');
            $filePdfmerger = public_path('pdf_file/' . $random_string_merger . '.pdf');
            $pdf->save($filePdforigin);


            // Pdf Merge
            $pdfMerger = PDFMerger::init();

            // Get File And Merge
            if (count($lampiran) > 0) {
                $pdfMerger->addPDF($filePdforigin, 'all');
                foreach ($lampiran as $l) {
                    foreach ($l as $value) {
                        $pdfMerger->addPDF(public_path(substr($value, 1)), 'all');
                    }
                }

                $pdfMerger->merge();

                // Download Original File
                unlink($filePdforigin);

                // Save File
                $pdfMerger->save($filePdfmerger);
                $response = Response::file($filePdfmerger, ['Content-Type' => 'application/pdf', "Content-Disposition" =>
                "attachment; filename=print.pdf"]);
            } else {
                $response = Response::file($filePdforigin, ['Content-Type' => 'application/pdf', "Content-Disposition" =>
                "attachment; filename=print.pdf"]);
            }
        } else if ($request->format == "word") {
            if (count($lampiran) > 0) {
                $tmp_lampiran = [];

                foreach ($lampiran as $l) {
                    foreach ($l as $value) {
                        $file = explode('/', $value);
                        $filename = str_replace('.pdf', '', end($file));
                        array_push($tmp_lampiran, $filename);
                    }
                }

                $lampiran = $tmp_lampiran;

                array_push($data_printed, 'lampiran');
            }

            $view = view('print_word', compact($data_printed))->render();

            // Save Rendered View DOCX
            $random_string_origin = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
            $filename = $random_string_origin . '.doc';
            $fileDocx = public_path('word_file/' . $filename);
            // Save File
            file_put_contents($fileDocx, $view);

            // Get File And Merge

            // Download Original File
            $response = Response::file($fileDocx, ['Content-Type' => 'application/msword', "Content-Disposition" =>
            "attachment; filename=print.doc"]);
        }

        // Send file as response
        return $response->deleteFileAfterSend(true);
    }

    public function print_word()
    {

        $view = view('print_word')->render();

        // Save Rendered View DOCX
        $random_string_origin = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
        $fileDocx = public_path('pdf_file/' . $random_string_origin . '.docx');
        $fileDocxMerger = public_path('pdf_file/' . $random_string_origin . '_merger.docx');

        // Save File
        file_put_contents($fileDocx, $view);
    }

    public function get_wilayah()
    {
        $coordinates = $this->coordinates;
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $wilayah = Http::withoutVerifying()->asForm()->withToken($this->token)->patch("$this->url_api/wilayah", [
            "lng" => $lng,
            "lat" => $lat,
        ])->json();

        return $wilayah['features'] == null ? '-' : $wilayah['features'][0]['properties'];
    }

    public function get_eksisting()
    {
        $coordinates = $this->coordinates;
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $eksisting = Http::withoutVerifying()->asForm()->withToken($this->token)->post("$this->url_api/eksisting", [
            "lng" => $lng,
            "lat" => $lat,
        ])->json();

        return $eksisting['features'] == null ? '-' : $eksisting['features'][0]['properties'];
    }

    public function get_njop()
    {
        $coordinates = $this->coordinates;
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $njop = Http::withoutVerifying()->asForm()->withToken($this->token)->post("$this->url_api/njop", [
            "lng" => $lng,
            "lat" => $lat,
        ])->json();

        return $njop['features'] == null ? null : $njop['features'][0]['properties'];
    }

    public function get_rerata_njop($kelurahan)
    {
        $rerata_njop = Http::withoutVerifying()->asForm()->withToken($this->token)->put("$this->url_api/njop", [
            "kelurahan" => $kelurahan,
        ])->json();

        return $rerata_njop['features'] == null ? null : $rerata_njop['features'][0]['properties'];
    }

    public function get_bpn()
    {
        $coordinates = $this->coordinates;
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $bpn = Http::withoutVerifying()->asForm()->withToken($this->token)->post("$this->url_api/bpn", [
            "lng" => $lng,
            "lat" => $lat,
        ])->json();

        return $bpn['features'] == null ? null : $bpn['features'][0]['properties'];
    }

    public function get_distribusi_wilayah($kelurahan)
    {
        $distribusi_wilayah = Http::withoutVerifying()->asForm()->withToken($this->token)->post("$this->url_api/distribusi_wilayah", [
            "kelurahan" => $kelurahan,
        ])->json();

        $data_distribusi_wilayah = [
            '2014' => [],
            '2022' => [],
        ];

        if (count($distribusi_wilayah['features'])) {
            foreach ($distribusi_wilayah['features'] as $dw) {
                if ($dw['properties']['tahun'] == 2014) {
                    array_push($data_distribusi_wilayah['2014'], $dw['properties']);
                } else if ($dw['properties']['tahun'] == 2022) {
                    array_push($data_distribusi_wilayah['2022'], $dw['properties']);
                }
            }
        }

        return $distribusi_wilayah['features'] == null ? null : $data_distribusi_wilayah;
    }

    public function get_distribusi_nib($kelurahan)
    {
        $distribusi_nib = Http::withoutVerifying()->asForm()->withToken($this->token)->post("$this->url_api/distribusi_nib", [
            "kelurahan" => $kelurahan,
        ])->json();

        $data_distribusi_nib = [
            'sektor' => [],
            'color' => [],
            'jumlah' => [],
            'jumlah_investasi' => [],
            'tenaga_kerja' => [],
            'legend' => [
                'label' => [],
                'color' => [],
                'hex_color' => [],
            ],
        ];

        if (count($distribusi_nib['features'])) {
            foreach ($distribusi_nib['features'] as $dw) {
                array_push($data_distribusi_nib['sektor'], $dw['properties']['sektor']);
                array_push($data_distribusi_nib['color'], $this->hexToRgba($dw['properties']['color']));
                array_push($data_distribusi_nib['jumlah'], $dw['properties']['jumlah']);
                array_push($data_distribusi_nib['jumlah_investasi'], $dw['properties']['jumlah_investasi']);
                array_push($data_distribusi_nib['tenaga_kerja'], $dw['properties']['tenaga_kerja']);
                array_push($data_distribusi_nib['legend']['label'], $dw['properties']['sektor']);
                array_push($data_distribusi_nib['legend']['color'], $this->hexToRgba($dw['properties']['color']));
                array_push($data_distribusi_nib['legend']['hex_color'], $dw['properties']['color']);
            }

            $data_distribusi_nib['sektor'] = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $data_distribusi_nib['sektor']));
            $data_distribusi_nib['color'] = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $data_distribusi_nib['color']));
            $data_distribusi_nib['jumlah'] = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $data_distribusi_nib['jumlah']));
            $data_distribusi_nib['jumlah_investasi'] = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $data_distribusi_nib['jumlah_investasi']));
            $data_distribusi_nib['tenaga_kerja'] = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $data_distribusi_nib['tenaga_kerja']));
        }

        return $distribusi_nib['features'] == null ? null : $data_distribusi_nib;
    }

    function hexToRgba($hex, $opacity = 1)
    {
        // Remove any leading '#' from the hex code
        $hex = str_replace('#', '', $hex);

        // Extract the individual color components
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        // Create the RGBA string
        $rgba = "rgba($r, $g, $b, $opacity)";

        return $rgba;
    }

    public function get_poi()
    {
        $coordinates = $this->coordinates;
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $rad = $this->radius;
        $poi = Http::withoutVerifying()->asForm()->withToken($this->token)->put("$this->url_api/poi", [
            "lng" => $lng,
            "lat" => $lat,
            "rad" => $rad,
        ])->json();

        // Grouping Array
        $grouped = $poi['features'] == null ? null : collect($poi['features'])->pluck('properties')->groupBy('Kategori');

        return $grouped;
    }

    public function get_urban_index()
    {
        $coordinates = $this->coordinates;
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $urban = Http::withoutVerifying()->asForm()->withToken($this->token)->put("$this->url_api/urban", [
            "lng" => $lng,
            "lat" => $lat,
        ])->json();

        return $urban['features'] == null ? null : $urban['features'][0]['properties'];
    }

    public function get_ddl_index()
    {
        $coordinates = $this->coordinates;
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $ddl = Http::withoutVerifying()->asForm()->withToken($this->token)->post("$this->url_api/ddl", [
            "lng" => $lng,
            "lat" => $lat,
        ])->json();

        return $ddl['features'] == null ? null : $ddl['features'][0]['properties'];
    }

    public function get_livability_index()
    {
        $coordinates = $this->coordinates;
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $livability = Http::withoutVerifying()->asForm()->withToken($this->token)->post("$this->url_api/liveability", [
            "lng" => $lng,
            "lat" => $lat,
        ])->json();

        return $livability['features'] == null ? null : $livability['features'][0]['properties'];
    }

    public function save_image(Request $request)
    {
        session()->forget('img');
        $image = $request->input('img');
        session()->forget('img');
        session()->save();
        session()->put('img', $image);
        session()->put('img_kajian', $image);
    }

    public function save_wilayah(Request $request)
    {
        session()->forget('wilayah');
        session()->save();
        $wilayah = $request->input('wilayah');
        session()->put('wilayah', $wilayah);
        session()->put('wilayah_kajian', $wilayah);
    }

    public function save_kordinat(Request $request)
    {
        session()->forget('kordinat');
        session()->save();
        $kordinat = $request->input('kordinat');
        session()->put('kordinat', $kordinat);
        session()->put('kordinat_kajian', $kordinat);
    }

    public function save_eksisting(Request $request)
    {
        session()->forget('eksisting');
        session()->save();
        $eksisting = $request->input('eksisting');
        session()->put('eksisting', $eksisting);
        session()->put('eksisting_kajian', $eksisting);
    }

    public function save_njop(Request $request)
    {
        session()->forget('njop');
        session()->save();
        $njop = $request->input('njop');
        session()->put('njop', $njop);
        session()->put('njop_kajian', $njop);
    }

    public function save_bpn(Request $request)
    {
        session()->forget('bpn');
        session()->save();
        $bpn = $request->input('bpn');
        session()->put('bpn', $bpn);
        session()->put('bpn_kajian', $bpn);
    }

    public function save_chart_pie(Request $request)
    {
        session()->forget('chart_pie');
        $chart_pie = $request->input('pie');
        session()->put('chart_pie', $chart_pie);
        session()->put('chart_pie_kajian', $chart_pie);
    }

    public function save_chart_bar(Request $request)
    {
        session()->forget('chart_bar');
        $chart_bar = $request->input('bar');
        session()->put('chart_bar', $chart_bar);
        session()->put('chart_bar_kajian', $chart_bar);
    }

    public function save_sanitasi(Request $request)
    {
        session()->forget('sanitasi');
        $sanitasi = $request->input('sanitasi');
        session()->put('sanitasi', $sanitasi);
        session()->put('sanitasi_kajian', $sanitasi);
    }

    public function save_turun(Request $request)
    {
        session()->forget('turun');
        $turun = $request->input('turun');
        session()->put('turun', $turun);
        session()->put('turun_kajian', $turun);
    }

    public function save_air_tanah(Request $request)
    {
        session()->forget('air_tanah');
        $air_tanah = $request->input('air_tanah');
        session()->put('air_tanah', $air_tanah);
        session()->put('air_tanah_kajian', $air_tanah);
    }

    public function save_zoning(Request $request)
    {
        session()->forget('zoning');
        session()->save();
        $zoning = $request->input('zoning');
        session()->put('zoning', $zoning);
        session()->put('zoning_kajian', $zoning);
    }

    public function save_itbx(Request $request)
    {
        session()->forget('itbx');
        $itbx = $request->input('itbx');
        session()->put('itbx', $itbx);
        session()->put('itbx_kajian', $itbx);
    }

    public function save_ketentuan(Request $request)
    {
        session()->forget('ketentuan_properties');
        session()->save();
        $ketentuan = $request->input('ketentuan');
        session()->put('ketentuan_properties', $ketentuan);

        return json_encode($ketentuan, 1);
    }

    public function save_ketentuan_tpz(Request $request)
    {
        session()->forget('ketentuan_tpz');
        $ketentuan_tpz = $request->input('ketentuan_tpz');
        session()->put('ketentuan_tpz', $ketentuan_tpz);
        session()->put('ketentuan_tpz_kajian', $ketentuan_tpz);
    }

    public function save_ketentuan_khusus(Request $request)
    {
        session()->forget('ketentuan_khusus');
        $ketentuan_khusus = $request->input('ketentuan_khusus');
        session()->put('ketentuan_khusus', $ketentuan_khusus);
        session()->put('ketentuan_khusus_kajian', $ketentuan_khusus);
    }

    public function save_poi(Request $request)
    {
        session()->forget('poi');
        session()->save();
        $poi = $request->input('poi');
        session()->put('poi', $poi);
        session()->put('poi_kajian', $poi);
    }

    public function save_kbli(Request $request)
    {
        session()->forget('kbli_properties');
        session()->save();
        $kbli = $request->all();
        session()->put('kbli_properties', $kbli);
        // session()->put('kbli_kajian', $kbli);
        // $param_kbli = $request->input('param_kbli');
        // session()->put('param_kbli', $param_kbli);
        // session()->put('param_kbli_kajian', $param_kbli);
    }

    public function save_lingkungan(Request $request)
    {
        session()->forget('lingkungan_properties');
        session()->save();
        $lingkungan = $request->input('lingkungan');
        session()->put('lingkungan_properties', $lingkungan);
    }

    public function save_potensi(Request $request)
    {
        session()->forget('potensi_properties');
        session()->save();
        $potensi = $request->input('potensi');
        session()->put('potensi_properties', $potensi);
    }

    public function check_print(Request $request)
    {
        $kategori = $request->input('kategeori');
        $status = $request->input('status');
        session()->forget($kategori);
        session()->save();
        return session()->put($kategori, $status);
    }

    public function reset_check_print(Request $request)
    {
        session()->forget($this->list_session);
        session()->save();
    }
}
