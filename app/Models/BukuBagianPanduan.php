<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuBagianPanduan extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_buku_panduan';

    protected $guarded = ['id'];

    public $timestamps = false;
}
