<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class PendataanUsaha extends Model
{
    use HasFactory, HasRoles;
    protected $connection = 'pgsql';
    protected $table = 'tbl_izin_usaha';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function image()
    {
        return $this->hasMany(ImagePendataanUsaha::class, 'id_survey', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
