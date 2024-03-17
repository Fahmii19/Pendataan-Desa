<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipIzinLingkugan extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'admin.tbl_arsip_izin_lingkungan';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function arsip_file()
    {
        return $this->hasMany(ArsipFileIzinLingkugan::class, 'nomor_permohonan', 'nomor_permohonan');
    }
}
