<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChanelChat extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tbl_chanel_chat';
    protected $guarded = ['id'];
}
