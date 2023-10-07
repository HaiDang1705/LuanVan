<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Post;
use App\Models\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getHome()
    {
        $data['post_views'] = Post::orderBy('post_view', 'DESC')->take(10)->get();
        $data['product_views'] = Product::orderBy('product_view', 'DESC')->take(10)->get();

        // Lấy tổng số lượng sản phẩm
        $product = app(ProductController::class);
        $totalProducts = $product->countProduct();
        $data['totalProducts'] = $totalProducts;

        // Lấy tổng số lượng bài đăng
        $post = app(BaiDangController::class);
        $totalPosts = $post->countPost();
        $data['totalPosts'] = $totalPosts;

        // Lấy tổng số lượng đơn hàng
        $order = app(OrderController::class);
        $totalOrders = $order->countOrder();
        $data['totalOrders'] = $totalOrders;

        // Tính tổng doanh thu ở đây
        $totalDoanhThu = DB::table('lv_shipping')
            ->where('shipping_states', 2)
            ->sum('shipping_total');
        $data['totalDoanhThu'] = number_format($totalDoanhThu, 0, ',', '.');

        return view('admin.index', $data);
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect()->intended('login');

        // session()->forget('user_role'); // Xóa vai trò người dùng khỏi session
        // return redirect()->intended('login');
    }

    public function getStatistic()
    {
    }
}
