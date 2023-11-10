<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_shipping';
    protected $primaryKey = 'shipping_id';
    protected $guarded = [];
    // protected $casts = [
    //     'shipping_total' => 'float',
    // ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id', 'p_transaction_id');
    }
}
