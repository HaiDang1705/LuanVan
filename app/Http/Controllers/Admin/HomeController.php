<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Post;
use App\Models\Models\Product;
use App\Models\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getHome()
    {
        $data['post_views'] = Post::orderBy('post_view', 'DESC')->take(10)->get();
        $data['product_views'] = Product::orderBy('product_view', 'DESC')->take(10)->get();

        $bestSellingProducts = DB::table('lv_shipping_details')
            ->select('shipping_details_product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('shipping_details_product_id')
            ->orderBy('total_sold', 'DESC')
            ->take(5)
            ->get();

        // Lấy danh sách các sản phẩm bán chạy nhất
        $bestSellingProductIds = $bestSellingProducts->pluck('shipping_details_product_id')->toArray();

        // Thực hiện truy vấn JOIN để lấy thông tin sản phẩm từ bảng lv_product
        $products = DB::table('lv_product')
            ->whereIn('product_id', $bestSellingProductIds)
            ->select('product_name', 'product_id')
            ->get();

        // Kết hợp thông tin sản phẩm và tổng số lượng bán được
        $result = $bestSellingProducts->map(function ($item) use ($products) {
            $product = $products->where('product_id', $item->shipping_details_product_id)->first();
            return [
                'product_name' => $product->product_name,
                'total_sold' => $item->total_sold,
            ];
        });

        $data['bestSellingProducts'] = $result;

        // dd($bestSellingProducts);

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

        // Tính tổng lợi nhuận (60% của tổng doanh thu)
        $totalLoiNhuan = $totalDoanhThu * 0.6;
        $data['totalLoiNhuan'] = number_format($totalLoiNhuan, 0, ',', '.');

        // Tính tổng số lượng sản phẩm đã bán
        $totalSoldProducts = (new OrderController)->countSoldProducts();
        $data['totalSoldProducts'] = $totalSoldProducts;

        // Tính tổng số lượng lượt xem của sản phẩm và bài đăng
        $totalView = (new ProductController)->countViewProductsAndPosts();
        $data['totalView'] = $totalView;

        // Tính tổng khách hàng
        $post = app(UserController::class);
        $totalCustomers = $post->countCustomer();
        $data['totalCustomers'] = $totalCustomers;

        // Tính tổng sản phẩm trong tồn trong kho
        $totalProductsKho = (new ProductController)->countProductKho();
        $data['totalProductsKho'] = $totalProductsKho;

        // Tính tổng sản phẩm trong tồn trong kho
        $totalMinusProductsKho = (new ProductController)->minusProductKho();
        $data['totalMinusProductsKho'] = $totalMinusProductsKho;

        // Tính tổng số bình luận
        $totalComments = (new CommentController)->countComment();
        $data['totalComments'] = $totalComments;

        // Doanh số

        // Lấy dữ liệu từ bảng lv_shipping
        $shippingData = DB::table('lv_shipping')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(shipping_total) as total_sales'))
            ->where('shipping_states', 2)
            ->groupBy('date')
            ->get();

        $doanhSoData = [];

        // Duyệt qua mảng dữ liệu để tính toán doanh số
        foreach ($shippingData as $shipping) {
            $totalSales = floatval($shipping->total_sales);
            $profit = $totalSales * 0.6; // 60%

            $doanhSoData[] = [
                'created_at' => $shipping->date,
                'doanh_so' => $totalSales,
                'loi_nhuan' => $profit, // Add profit data
            ];
        }
        $data['doanhSoData'] = $doanhSoData;

        return view('admin.index', $data);
    }

    public function filterData(Request $request)
    {
        $fromDate = date('Y-m-d', strtotime($request->input('from_date')));
        $toDate = date('Y-m-d', strtotime($request->input('to_date')));

        // Truy vấn cơ sở dữ liệu của bạn để lấy dữ liệu đã lọc dựa trên $fromDate và $toDate
        $filteredData = DB::table('lv_shipping')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(shipping_total) as total_sales')
            )
            ->where('shipping_states', 2)
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<', $toDate)
            ->groupBy('date')
            ->get();

        $filteredDoanhSoData = [];

        // Duyệt qua dữ liệu đã lọc để tính lợi nhuận và tạo cấu trúc dữ liệu
        foreach ($filteredData as $shipping) {
            $totalSales = floatval($shipping->total_sales);
            $profit = $totalSales * 0.6;

            $filteredDoanhSoData[] = [
                'created_at' => $shipping->date,
                'doanh_so' => $totalSales,
                'loi_nhuan' => $profit,
            ];
        }

        // Trả về dữ liệu đã lọc dưới dạng phản hồi JSON
        return response()->json($filteredDoanhSoData);
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
