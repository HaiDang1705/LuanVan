<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'lv_messages';
    protected $primaryKey = 'id';
    protected $fillable = ['from', 'to', 'message', 'is_read'];
}
