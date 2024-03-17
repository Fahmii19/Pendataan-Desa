<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PesanAjib extends Controller
{
    protected $url = 'http://api.dpmptsp-jkt.com/api';
    protected $token = '999|GRvhv1ipKGiU633l4dsXADqEyexTIMsItOCN6X0I';
    protected $testing = false;

    // Set Header to Json
    public function __construct()
    {
        header('Content-Type: application/json');
    }

    // Get Ajib Kelurahan
    public function get_list_ajib(Request $request)
    {
        $result = Http::withHeaders(['Authorization' => 'Bearer ' . $this->token])->post($this->url . '/getListAjib', [
            'kel' => $request->kelurahan,
        ]);

        if ($result->successful()) {
            return response()->json($result->json());
        } else {
            return response(400)->json($result->json());
        }

        return $result;
    }

    // Save Permohonan
    public function save_permohonan(Request $request)
    {
        $payload = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nohp' => $request->no_hp,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'kelurahan' => $this->testing ? "Pengadegan" : $request->kelurahan,
            'kecamatan' => $this->testing ? "Kecamatan Pancoran" : "Kecamatan " . $request->kecamatan,
            'kota' => $this->testing ? "Jakarta Selatan" : $request->kota,
            'alamat' => $request->alamat,
            'jenis' => $request->jenis,
            'idajib' => $this->testing ? 9313 : $request->id_ajib,
            'iduser' => Auth::user()->id,
        ];

        $result = Http::asForm()->withHeaders(['Authorization' => 'Bearer ' . $this->token])->post($this->url . '/SavePermohonan', $payload);

        if ($result->successful()) {
            return response()->json($result->json());
        } else {
            return response($result->json(), 400);
        }
    }

    // Get List Izin
    public function get_izin_ajib(Request $request)
    {
        $result = Http::withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url . '/getIzinAjib');

        if ($result->successful()) {
            return response()->json($result->json());
        } else {
            return response($result->json(), 400);
        }
    }

    // Get Data Persyaratan
    public function get_persyaratan(Request $request)
    {
        $result = Http::withHeaders(['Authorization' => 'Bearer ' . $this->token])->post($this->url . '/getPersyaratan', [
            'id' => $request->id
        ]);

        if ($result->successful()) {
            return response()->json($result->json());
        } else {
            return response($result->json(), 400);
        }
    }

    // Get Data Permohonan
    public function get_permohonan(Request $request)
    {
        $id_user = Auth::user()->id;
        $result = Http::withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url . "/getDataPermohonan", [
            'iduser' => $id_user,
            'page' => $request->page,
        ]);

        if ($result->successful()) {
            return response()->json($result->json());
        } else {
            return response($result->json(), 400);
        }
    }

    //Search Permohonan
    public function search_permohonan(Request $request)
    {
        $id_user = Auth::user()->id;
        $result = Http::withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url . "/searchPermohonanJakpintas", [
            'iduser' => $id_user,
            'search' => $request->keyword,
            'page' => $request->page,
        ]);

        if ($result->successful()) {
            return response()->json($result->json());
        } else {
            return response($result->json(), 400);
        }
    }
}
