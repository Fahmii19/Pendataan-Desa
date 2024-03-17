<?php

namespace App\Http\Controllers;

use App\Models\NomorIndukBerusaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MStaack\LaravelPostgis\Geometries\Point;

class NibController extends Controller
{

    public function __construct()
    {
        header('Content-Type: application/json');
    }

    public function save_nib(Request $request)
    {
        if (Auth::user()->email !== 'guest@dpmptsp-dki.com') {
            $data = $request->all();
            $coordinates = explode(',', $data['wkb_geometry']);
            $lat = (float)$coordinates[0];
            $lng = (float)$coordinates[1];
            $data['wkb_geometry'] = DB::connection('pgsql')->raw("ST_SetSRID(ST_MakePoint($lng::double precision,$lat::double precision),4326)");

            $nib = NomorIndukBerusaha::where('ogc_fid', $data['ogc_fid'])->first();

            //remove ogc_fid
            unset($data['ogc_fid']);
            //update data
            try {
                $nib->nib = $data['nib'];
                $nib->skala = $data['uraian_skala_usaha'];
                $nib->kbli = $data['kbli'];
                $nib->jumlah_investasi = $data['jumlah_investasi_lain'];
                $nib->resiko = $data['uraian_risiko_proyek'];
                $nib->wkb_geometry = $data['wkb_geometry'];

                $nib->save();

                return $nib;
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                return response(400)->json($e->getMessage());
            }
        }
    }
}
