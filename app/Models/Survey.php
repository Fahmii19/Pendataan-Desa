<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = "tbl_kondisi_lingkungan";

    protected $guarded = ["id"];

    public $timestamps = false;
}
