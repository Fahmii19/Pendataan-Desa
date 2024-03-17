<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketingUsaha extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'tbl_ticket_usaha';
    protected $guarded = [];
    public $timestamps = false;
}
