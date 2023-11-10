<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_payments';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
