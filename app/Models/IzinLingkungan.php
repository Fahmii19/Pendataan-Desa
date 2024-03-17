<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class IzinLingkungan extends Model
{
    use HasFactory, HasRoles;

    protected $connection = 'pgsql';

    protected $table = 'admin.tbl_izin_lingkungan';

    protected $guarded = ['ogc_fid'];

    public $timestamps = false;

    public function arsip_file()
    {
        return $this->hasMany(ArsipFileIzinLingkugan::class, 'nomor_permohonan', 'nomor_permohonan');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
