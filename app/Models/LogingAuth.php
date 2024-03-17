<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogingAuth extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'admin.tbl_loging_auth';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
