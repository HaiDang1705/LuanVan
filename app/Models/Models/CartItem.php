<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    // use HasFactory;
    protected $table = 'lv_cart';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
