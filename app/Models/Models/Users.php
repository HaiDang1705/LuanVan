<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_users';
    protected $primaryKey = 'user_id';
    protected $guarded = [];
}
