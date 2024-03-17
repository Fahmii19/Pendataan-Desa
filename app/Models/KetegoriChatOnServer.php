<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetegoriChatOnServer extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_kategori_chat';
    protected $guarded = ['id'];

    public function chanel()
    {
        return $this->hasMany(ChanelChat::class, 'id_kategori', 'id');
    }
}
