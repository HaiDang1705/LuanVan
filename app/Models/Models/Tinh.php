<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tinh extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_tinh';
    protected $primaryKey = 'tinh_id';
    protected $guarded = [];
}
