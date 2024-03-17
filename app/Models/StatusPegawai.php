<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPegawai extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_status_pegawai';
    protected $guarded = ['id'];
}
