<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xa extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_xa';
    protected $primaryKey = 'xa_id';
    protected $guarded = [];
}
