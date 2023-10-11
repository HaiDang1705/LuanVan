<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuantity extends Model
{
    // use HasFactory;
    protected $table = 'lv_product_quantities';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
