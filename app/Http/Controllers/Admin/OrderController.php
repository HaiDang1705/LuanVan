<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị đơn hàng
    public function getOrder()
    {
        return view('admin.quanly_donhang');
    }

    // Chi tiết đơn hàng
    public function getChiTietOrder()
    {
        return view('admin.chitiet_donhang');
    }
    // Sửa đơn hàng
    public function getEditOrder()
    {
        
    }
    public function postEditOrder()
    {
        
    }

    // Xóa đơn hàng
    public function getDeleteOrder()
    {
        
    }
}