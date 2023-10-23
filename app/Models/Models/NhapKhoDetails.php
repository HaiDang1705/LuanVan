<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhapKhoDetails extends Model
{
    // use HasFactory;
    // ten bang csdl
    protected $table = 'lv_nhapkho_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
