<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBagianPanduan extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_sub_bagian_panduan';

    protected $guarded = ['id'];

    public $timestamps = true;
}
