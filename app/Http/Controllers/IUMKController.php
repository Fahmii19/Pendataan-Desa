<?php

namespace App\Http\Controllers;

use App\Models\IUMK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IUMKController extends Controller
{
    public function update_iumk(Request $request)
    {
        $iumk = IUMK::where("ogc_fid", $request->ogc_fid)->first();
        $iumk->nama = $request->nama_pemilik;
        $iumk->nama_usaha = $request->nama_usaha;
        $iumk->alamat_usaha_split = $request->alamat_usaha;
        $iumk->npwp = $request->npwp;
        $iumk->nik_pelaku_usaha = $request->nik;
        $iumk->penilaian = $request->penilaian;
        $iumk->star = $request->star;
        $iumk->perizinan = $request->perizinan;
        $iumk->omzet_tahunan = $request->omzet_tahunan;
        $coordinates = explode(',', $request->wkb_geometry);
        $lat = (float)$coordinates[0];
        $lng = (float)$coordinates[1];
        $iumk->lat = $lat;
        $iumk->lng = $lng;
        if ($request->perizinan == "NIB") {
            $iumk->no_nib = $request->no_izin;
        } else if ($request->perizinan == "Halal") {
            $iumk->no_halal = $request->no_izin;
        } else {
            $iumk->no_izin_edar = $request->no_izin;
        }
        $iumk->save();

        return json_encode($request->all());
    }
}
