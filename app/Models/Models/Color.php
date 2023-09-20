<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'lv_colorproduct';
    protected $primaryKey = 'color_id';
    protected $guarded = [];
}
