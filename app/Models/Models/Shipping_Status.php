<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_Status extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_shipping_status';
    protected $primaryKey = 'status_id';
    protected $guarded = [];
}
