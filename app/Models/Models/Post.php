<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'lv_post';
    protected $primaryKey = 'post_id';
    protected $guarded = [];
}
