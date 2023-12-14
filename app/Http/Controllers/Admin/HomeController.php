<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Message;
use App\Models\Models\Post;
use App\Models\Models\Product;
use App\Models\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Pusher\Pusher;

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
        // $post = app(BaiDangController::class);
        // $totalPosts = $post->countPost();
        // $data['totalPosts'] = $totalPosts;

        // Lấy tổng số lượng đơn hàng
        $order = app(OrderController::class);
        $totalOrders = $order->countOrder();
        $data['totalOrders'] = $totalOrders;

        // Tính tổng doanh thu ở đây
        $totalDoanhThu = DB::table('lv_shipping')
            ->where('shipping_states', 2)
            ->sum('shipping_total');
        $data['totalDoanhThu'] = number_format($totalDoanhThu, 0, ',', '.');

        // --------------------------------------------------------------------------
        // Tính tổng lợi nhuận (60% của tổng doanh thu)
        // $totalLoiNhuan = $totalDoanhThu * 0.6;
        $totalLoiNhuan = DB::table('lv_shipping')
            ->where('shipping_states', 2)
            ->sum('shipping_profit');
        $data['totalLoiNhuan'] = number_format($totalLoiNhuan, 0, ',', '.');
        // --------------------------------------------------------------------------

        // Tính tổng số lượng sản phẩm đã bán
        // $totalSoldProducts = (new OrderController)->countSoldProducts();
        // $data['totalSoldProducts'] = $totalSoldProducts;

        // Tính tổng số lượng lượt xem của sản phẩm và bài đăng
        // $totalView = (new ProductController)->countViewProductsAndPosts();
        // $data['totalView'] = $totalView;

        // Tính tổng khách hàng
        // $post = app(UserController::class);
        // $totalCustomers = $post->countCustomer();
        // $data['totalCustomers'] = $totalCustomers;

        // Tính tổng sản phẩm trong tồn trong kho
        // $totalProductsKho = (new ProductController)->countProductKho();
        // $data['totalProductsKho'] = $totalProductsKho;

        // Tính tổng sản phẩm trong tồn trong kho
        // $totalMinusProductsKho = (new ProductController)->minusProductKho();
        // $data['totalMinusProductsKho'] = $totalMinusProductsKho;

        // Tính tổng số bình luận
        // $totalComments = (new CommentController)->countComment();
        // $data['totalComments'] = $totalComments;

        // Doanh số

        // Lấy dữ liệu từ bảng lv_shipping để làm cho biểu đồ doanh thu / lợi nhuận
        $shippingData = DB::table('lv_shipping')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(shipping_total) as total_sales'),
                DB::raw('SUM(shipping_profit) as profit_sales'),
                DB::raw('SUM(shipping_slug) as total_quantity'),
                // DB::raw('SUM(lv_shipping_details.quantity) as total_quantity')
            )
            // ->leftJoin('lv_shipping_details', 'lv_shipping.shipping_id', '=', 'lv_shipping_details.shipping_id')
            ->where('shipping_states', 2)
            ->groupBy('date')
            ->get();
        // dd($shippingData);
        $doanhSoData = [];

        // Duyệt qua mảng dữ liệu để tính toán doanh số
        foreach ($shippingData as $shipping) {
            $totalSales = floatval($shipping->total_sales);
            $profit = floatval($shipping->profit_sales);
            $totalQuantity = $shipping->total_quantity;

            $doanhSoData[] = [
                'created_at' => $shipping->date,
                'doanh_so' => $totalSales,
                'loi_nhuan' => $profit, // Add profit data
                'tong_sanpham' => $totalQuantity,
            ];
        }
        $data['doanhSoData'] = $doanhSoData;
        // dd($data['doanhSoData']);

        // Lấy dữ liệu từ bảng lv_shipping để làm cho biểu đồ nhập kho
        $nhapKho = DB::table('lv_nhapkho')
            ->select(
                DB::raw('DATE(lv_nhapkho.created_at) as date'),
                DB::raw('lv_nhapkho.nhapkho_total as total_nhap'),
                DB::raw('SUM(lv_nhapkho_details.quantity) as total_quantity')
            )
            ->leftJoin('lv_nhapkho_details', 'lv_nhapkho.nhapkho_id', '=', 'lv_nhapkho_details.nhapkho_id')
            ->groupBy('date', 'lv_nhapkho.nhapkho_total')
            ->get();
        // dd($nhapKho);

        $nhapKhoData = [];

        // Duyệt qua mảng dữ liệu để tính toán doanh số
        foreach ($nhapKho as $nhapkho) {
            $totalNhap = floatval($nhapkho->total_nhap);
            $quantityNhap = intval($nhapkho->total_quantity);

            $nhapKhoData[] = [
                'created_at' => $nhapkho->date,
                'tong_nhap' => $totalNhap,
                'tong_sanphamnhap' => $quantityNhap,
            ];
        }

        $data['nhapKhoData'] = $nhapKhoData;
        // dd($data['nhapKhoData']);

        //------------------------------------------------ Biểu đồ hình tròn
        // Truy xuất dữ liệu từ bảng lv_product_quantities
        $productData = DB::table('lv_product_quantities')
            ->join('lv_product', 'lv_product_quantities.product_id', '=', 'lv_product.product_id')
            ->select('lv_product.product_name', 'lv_product_quantities.product_quantity')
            ->get();

        // Tính tổng số lượng sản phẩm
        $totalQuantity = $productData->sum('product_quantity');

        // Xây dựng mảng dữ liệu cho biểu đồ
        $piedata = [['Product', 'Percentage']];
        foreach ($productData as $product) {
            $percentage = ($product->product_quantity / $totalQuantity) * 100;
            $piedata[] = [$product->product_name, $percentage];
        }

        // Chuyển mảng dữ liệu sang JSON để sử dụng trong JavaScript
        $piedataJson = json_encode($piedata);
        $data['piedataJson'] = $piedataJson;
        // dd($data['piedataJson']);

        return view('admin.index', $data);
    }

    public function filterData(Request $request)
    {
        $fromDate = date('Y-m-d', strtotime($request->input('from_date')));
        $toDate = date('Y-m-d', strtotime($request->input('to_date')));

        // Thêm 1 ngày vào $toDate sử dụng lớp Carbon
        $toDate = Carbon::parse($toDate)->addDays(1)->format('Y-m-d');

        // Truy vấn cơ sở dữ liệu của bạn để lấy dữ liệu đã lọc dựa trên $fromDate và $toDate
        $filteredDoanhSoData = DB::table('lv_shipping')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(shipping_total) as total_sales'),
                DB::raw('SUM(shipping_profit) as profit_sales'),
                DB::raw('SUM(shipping_slug) as total_quantity'),
            )
            ->where('shipping_states', 2)
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate)
            ->groupBy('date')
            ->get();

        $filteredDoanhSoDataFormatted = [];

        // Duyệt qua dữ liệu đã lọc để tính lợi nhuận và tạo cấu trúc dữ liệu
        foreach ($filteredDoanhSoData as $shipping) {
            $totalSales = floatval($shipping->total_sales);
            $profit = floatval($shipping->profit_sales);
            $totalQuantity = intval($shipping->total_quantity);

            $filteredDoanhSoDataFormatted[] = [
                'created_at' => $shipping->date,
                'doanh_so' => $totalSales,
                'loi_nhuan' => $profit,
                'tong_sanpham' => $totalQuantity,
            ];
        }

        // Trả về dữ liệu đã lọc dưới dạng phản hồi JSON
        return response()->json($filteredDoanhSoDataFormatted);
    }

    public function filterDataNhapKho(Request $request)
    {
        $fromDate1 = date('Y-m-d', strtotime($request->input('from_date')));
        $toDate1 = date('Y-m-d', strtotime($request->input('to_date')));

        // Thêm 1 ngày vào $toDate sử dụng lớp Carbon
        $toDate1 = Carbon::parse($toDate1)->addDays(1)->format('Y-m-d');

        // Truy vấn cơ sở dữ liệu của bạn để lấy dữ liệu đã lọc dựa trên $fromDate và $toDate
        $filteredNhapKhoData = DB::table('lv_nhapkho')
            ->select(
                DB::raw('DATE(lv_nhapkho.created_at) as date'),
                DB::raw('SUM(lv_nhapkho.nhapkho_total) as nhapkho_total'),
                DB::raw('SUM(lv_nhapkho_details.quantity) as total_quantity')
            )
            ->join('lv_nhapkho_details', 'lv_nhapkho.nhapkho_id', '=', 'lv_nhapkho_details.nhapkho_id')
            ->where('lv_nhapkho.created_at', '>=', $fromDate1) // Chỉ định rõ trường 'created_at' đến từ bảng lv_nhapkho
            ->where('lv_nhapkho.created_at', '<=', $toDate1)  // Chỉ định rõ trường 'created_at' đến từ bảng lv_nhapkho
            ->groupBy('date')
            ->get();

        $filteredNhapKhoDataFormatted = [];

        // Duyệt qua dữ liệu đã lọc để tạo cấu trúc dữ liệu
        foreach ($filteredNhapKhoData as $nhapKho) {
            $totalNhapKho = floatval($nhapKho->nhapkho_total);
            $totalQuantityNhapKho = intval($nhapKho->total_quantity);

            $filteredNhapKhoDataFormatted[] = [
                'created_at' => $nhapKho->date,
                'tong_nhap' => $totalNhapKho,
                'tong_sanphamnhap' => $totalQuantityNhapKho,
            ];
        }

        // Trả về dữ liệu đã lọc dưới dạng phản hồi JSON
        return response()->json($filteredNhapKhoDataFormatted);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->intended('login');
    }

    public function getChat()
    {
        // $users = User::where('id', '!=', Auth::id())->get();

        $users = DB::select(
            "select lv_users.id, lv_users.name, lv_users.avatar, lv_users.email, count(is_read) as unread
        from lv_users 
        LEFT JOIN lv_messages ON lv_users.id = lv_messages.from and is_read = 0 and lv_messages.to = " . Auth::id() . "
        where lv_users.id != " . Auth::id() . "
        group by lv_users.id, lv_users.name, lv_users.avatar, lv_users.email"
        );

        return view('admin.chat', ['users' => $users]);
    }

    public function getMessage($user_id)
    {
        // return $user_id;
        $my_id = Auth::id();

        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->get();

        return view('admin.message', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->received_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();
        // dd($data);

        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
