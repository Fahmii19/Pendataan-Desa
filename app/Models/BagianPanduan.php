<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianPanduan extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_bagian_panduan';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function subBagianPanduan()
    {
        return $this->hasMany(SubBagianPanduan::class, 'id_bagian', 'id')->orderBy('id', 'ASC');
    }
}
