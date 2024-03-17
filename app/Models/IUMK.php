<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IUMK extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'admin.tbl_iumk_relaksasi_master';

    protected $primaryKey = 'ogc_fid';

    protected $fillable = [
        'ogc_fid',
        'nik_pelaku_usaha',
        'npwp',
        'nama',
        'nama_usaha',
        'alamat_usaha_split',
        'penilaian',
        'star',
        'perizinan',
        'omzet_tahunan',
        'no_izin_edar',
        'no_halal',
        'no_nib',
    ];

    public $timestamps = false;
}
