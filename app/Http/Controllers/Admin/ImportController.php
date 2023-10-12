<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Order;
use App\Models\Models\OrderCart;
use App\Models\Models\OrderDetail;
use App\Models\Models\ProductQuantity;
use App\Models\Models\Shipping_States;
use App\Models\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\App;

use function Symfony\Component\String\b;

class ImportController extends Controller
{
    // Hiển thị đơn hàng
    public function getImport()
    {
        $data['listproduct'] = DB::table('lv_product')
            ->join('lv_category', 'lv_product.product_cate', '=', 'lv_category.cate_id')
            ->join('lv_brand', 'lv_product.product_brand', '=', 'lv_brand.brand_id')
            ->join('lv_typeproduct', 'lv_product.product_type', '=', 'lv_typeproduct.type_id')
            ->join('lv_colorproduct', 'lv_product.product_color', '=', 'lv_colorproduct.color_id')
            // ->leftJoin('lv_product_quantities', 'lv_product.product_id', '=', 'lv_product_quantities.product_id')
            // ->select('lv_product.*', 'lv_product_quantities.product_quantity as product_quantity')
            ->orderBy('lv_product.product_id', 'asc')
            ->get();

        return view('admin.quanly_nhapxuat', $data);
    }

    
    // Tìm kiếm sản phẩm theo tên
    public function getSearch(Request $request)
    {
        
        $result = $request->result;
        $data['keyword'] = $result;
        $result = str_replace(' ', '%', $result);
        $data['items'] = DB::table('lv_product')
            ->join('lv_colorproduct', 'lv_product.product_color', '=', 'lv_colorproduct.color_id')
            ->where('product_name', 'like', '%' . $result . '%')
            ->orderBy('lv_product.product_id', 'asc')
            ->get();
        // $data['items'] = Product::where('product_name', 'like', '%' . $result . '%')->get();
        return view('admin.quanly_nhapxuat_search', $data);
    }

    // Đếm số lượng đơn hàng
    public function countOrder()
    {
        $totalOrders = Order::count();
        return $totalOrders;
    }
}
