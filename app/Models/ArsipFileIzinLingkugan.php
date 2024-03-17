<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipFileIzinLingkugan extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'admin.tbl_file_izin_lingkungan';

    protected $guarded = ['id'];

    public $timestamps = false;
}
