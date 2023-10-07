<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_States extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_shipping_states';
    protected $primaryKey = 'states_id';
    protected $guarded = [];
}
