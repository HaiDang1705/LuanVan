<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_binhluan';
    protected $primaryKey = 'bl_id';
    protected $guarded = [];
}
