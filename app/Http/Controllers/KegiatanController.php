<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KegiatanUser;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public static function checkUser($id_user, $id_kegiatan)
    {
        $data = KegiatanUser::where('id_user', $id_user)->where('id_kegiatan', $id_kegiatan)->first();
        if (!$data) {
            return true;
        } else {
            return false;
        }
    }

    public static function AssignKegiatan($id_user, $kegiatan)
    {

        $checkUser = self::checkUser($id_user, $kegiatan);

        if ($checkUser) {
            KegiatanUser::create([
                'id_user' => $id_user,
                'id_kegiatan' => $kegiatan,
            ]);
        }
    }

    public static function getName($id)
    {
        $data = Kegiatan::where('id', $id)->first();
        return $data->nama;
    }

    public static function updateKegiatan($id_user, $kegiatan)
    {
    }

    public static function assignAll($id_user)
    {
        $data = Kegiatan::all();
        foreach ($data as $d) {
            KegiatanUser::create([
                'id_user' => $id_user,
                'id_kegiatan' => $d->id,
            ]);
        }
    }
}
