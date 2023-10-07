<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'lv_customers';
    protected $primaryKey = 'id';
    // ...
}

