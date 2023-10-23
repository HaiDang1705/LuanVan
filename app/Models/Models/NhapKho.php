<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhapKho extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_nhapkho';
    protected $primaryKey = 'nhapkho_id';
    protected $guarded = [];
}
