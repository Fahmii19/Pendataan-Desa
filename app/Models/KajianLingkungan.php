<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KajianLingkungan extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_kajian_lingkungan';

    protected $guarded = ['id'];

    public $timestamps = false;
}
