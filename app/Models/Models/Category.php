<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_category';
    protected $primaryKey = 'cate_id';
    protected $guarded = [];
}
