<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorIndukBerusaha extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'admin.tbl_nib_update';

    protected $primaryKey = 'ogc_fid';

    protected $guarded = ["ogc_fid"];

    public $timestamps = false;
}
