<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huyen extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_huyen';
    protected $primaryKey = 'huyen_id';
    protected $guarded = [];
}
