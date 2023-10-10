<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_shipping_details';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function shippingState()
    {
        return $this->belongsTo(Shipping_States::class, 'shipping_id');
    }
}
