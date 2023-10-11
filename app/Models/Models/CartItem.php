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

    // Định nghĩa mối quan hệ với bảng sản phẩm (lv_product)
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'product_id');
    }
}
