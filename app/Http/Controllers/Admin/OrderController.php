<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Order;
use App\Models\Models\OrderDetail;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class OrderController extends Controller
{
    // Hiển thị đơn hàng
    public function getOrder()
    {
        $data['orderlist'] = Order::all();
        return view('admin.quanly_donhang', $data);
    }

    // Chi tiết đơn hàng
    public function getChiTietOrder($id)
    {
        $data['order'] = Order::find($id);
        // $data['orderdetail'] = OrderDetail::find($id);
        return view('admin.chitiet_donhang',$data);
    }
    // Sửa đơn hàng
    public function getEditOrder()
    {
        
    }
    public function postEditOrder()
    {
        
    }

    // Xóa đơn hàng
    public function getDeleteOrder($id)
    {
        Order::destroy($id);
        return back();
    }
}