<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    // use HasFactory;
    protected $table = 'lv_typeproduct';
    protected $primaryKey = 'type_id';
    protected $guarded = [];
}
