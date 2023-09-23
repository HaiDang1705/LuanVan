<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Order;
use App\Models\Models\OrderCart;
use App\Models\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class OrderController extends Controller
{
    // Hiển thị đơn hàng
    public function getOrder()
    {
        // $data['orderlist'] = Order::all();
        // $data['orderdetail'] = OrderDetail::all();
        $data['orderlist'] = DB::table('lv_shipping')
            ->join('lv_shipping_status', 'lv_shipping.shipping_status', '=', 'lv_shipping_status.status_id')
            ->orderBy('lv_shipping.shipping_id', 'asc')
            ->get();
        // $data['ordercart'] = OrderCart::all();
        return view('admin.quanly_donhang', $data);
    }

    // Chi tiết đơn hàng
    public function getChiTietOrder($id)
    {
        $data['order'] = Order::find($id);
        // Lấy tất cả các sản phẩm trong đơn hàng có shipping_id tương ứng
        $data['orderdetails'] = OrderDetail::where('shipping_id', $id)->get();

        // Tạo một mảng để lưu thông tin tên sản phẩm
        $data['product_names'] = [];

        // Lặp qua danh sách các sản phẩm trong đơn hàng
        foreach ($data['orderdetails'] as $orderdetail) {
            // Lấy thông tin sản phẩm từ bảng lv_product
            $product = DB::table('lv_product')
                ->where('product_id', $orderdetail->shipping_details_product_id)
                ->first();

            // Kiểm tra xem sản phẩm có tồn tại không
            if ($product) {
                // Thêm tên sản phẩm vào mảng product_names
                $data['product_names'][] = $product->product_name;
            }
        }

        // $data['ordercart'] = OrderCart::find($id);
        return view('admin.chitiet_donhang', $data);
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
