<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;
    protected $table = 'lv_product';
    protected $primaryKey = 'product_id';
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'product_brand', 'brand_id');
    }
}
