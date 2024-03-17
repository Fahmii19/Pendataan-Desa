<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerChat extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_server_chat';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->hasMany(KetegoriChatOnServer::class, 'id_server', 'id');
    }
}
