<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Order;
use App\Models\Models\OrderCart;
use App\Models\Models\OrderDetail;
use App\Models\Models\Payment;
use App\Models\Models\ProductQuantity;
use App\Models\Models\Shipping_States;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

use function Symfony\Component\String\b;

class OrderController extends Controller
{
    // Hiển thị đơn hàng
    public function getOrder()
    {
        $data['orderlist'] = DB::table('lv_shipping')
            ->join('lv_shipping_status', 'lv_shipping.shipping_status', '=', 'lv_shipping_status.status_id')
            ->orderBy('lv_shipping.shipping_id', 'asc')
            ->get();

        $data['shippingstates'] = Shipping_States::all();

        $data['payment'] = Payment::all();

        return view('admin.quanly_donhang', $data);
    }

    // Đếm số lượng đơn hàng
    public function countOrder()
    {
        $totalOrders = Order::count();
        return $totalOrders;
    }

    // Chi tiết đơn hàng
    public function getChiTietOrder($id)
    {
        $data['order'] = Order::find($id);
        // Lấy tất cả các sản phẩm trong đơn hàng có shipping_id tương ứng
        $data['orderdetails'] = OrderDetail::where('shipping_id', $id)->get();
        $data['liststates'] = Shipping_States::all();

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

    // Tìm kiếm dựa vào Shipping_states ( đã xử lý / chưa xử lý )
    public function getShippingStates($states_id = null)
    {
        $data['orderlist'] = DB::table('lv_shipping')
            ->join('lv_shipping_status', 'lv_shipping.shipping_status', '=', 'lv_shipping_status.status_id')
            ->orderBy('lv_shipping.shipping_id', 'asc');

        // Kiểm tra nếu $states_id được chọn thì áp dụng bộ lọc, nếu không, hiển thị tất cả.
        if ($states_id !== null && $states_id != 0) {
            $data['orderlist'] = $data['orderlist']->where('lv_shipping.shipping_states', $states_id);
        }

        $data['orderlist'] = $data['orderlist']->get();
        $data['shippingstates'] = Shipping_States::all();
        $data['payment'] = Payment::all();

        return view('admin.quanly_donhang_states', $data);
    }


    // Xử lý shipping_states - đã xử lý/chưa xử lý
    public function postChiTietOrder(Request $request, $id)
    {
        $order = Order::find($id);
        $order->shipping_states = $request->states;
        $order->save();
        return redirect('admin/donhang');
    }

    // Xóa đơn hàng
    public function getDeleteOrder($id)
    {
        // Lấy thông tin chi tiết đơn hàng
        $orderDetails = OrderDetail::where('shipping_id', $id)->get();

        foreach ($orderDetails as $orderDetail) {
            // Lấy thông tin sản phẩm và số lượng đã mua
            $productId = $orderDetail->shipping_details_product_id;
            $quantityPurchased = $orderDetail->quantity;

            // Cộng lại số lượng vào bảng lv_product_quantities
            $productQuantity = ProductQuantity::where('product_id', $productId)->first();
            $productQuantity->product_quantity += $quantityPurchased;
            $productQuantity->save();
        }

        Order::destroy($id);
        return back();
    }

    // In đơn hàng
    public function printOrder($checkout_code)
    {
        // $pdf = \App::make('dompdf.wrapper');
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($this->printOrderConvert($checkout_code));
        return $pdf->stream();
    }

    public function printOrderConvert($checkout_code)
    {
        // return $checkout_code;
        // $shipping = Order::where('shipping_id', $shipping_id)->first();
        $data['order'] = Order::find($checkout_code);
        // Lấy tất cả các sản phẩm trong đơn hàng có shipping_id tương ứng
        $data['orderdetails'] = OrderDetail::where('shipping_id', $checkout_code)->get();

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

        $order = Order::where('shipping_id', $checkout_code)->first();
        $order_details_product = OrderDetail::where('shipping_id', $checkout_code)->get();

        // Định dạng ngày
        $carbonDate = \Carbon\Carbon::parse($order->created_at);
        $formattedDate = "TP Cà Mau, ngày " . $carbonDate->format('d') . " tháng " . $carbonDate->format('m') . " năm " . $carbonDate->format('Y');

        $output = '';
        $output .= '
        <style>
            body {
                font-family: DejaVu Sans;
            }

            .table-styling {
                border: 1px solid #000;
            }

            .table-styling thead tr th,
            .table-styling tbody tr td {
                border: 1px solid #000;
            }

            .row::after {
                content: "";
                clear: both;
                display: table;
            }

            .col-6 {
                width: 50%;
                float: left;
            }

            .container {
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }
            .table-styling {
                border-collapse: collapse;
            }
        
            .table-styling thead tr th {
                border: 1px solid #000;
            }
        
            .table-styling tbody tr td {
                border: 1px solid #000;
            }
        
            .table-styling td[colspan="5"] {
                border: none; /* Loại bỏ đường viền của ô mở rộng */
            }
        </style>
        <h2 style="text-align: center;">CÔNG TY TNHH MTV Sơn Kim Cương Trúc Tiên</h2>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h5>Địa chỉ: 310 Lý Thường Kiệt, Khóm 2, Phường 6, TP Cà Mau</h5>
                    <h5 style="margin-top:-20px; margin-bottom:-5px">Tổng đài hỗ trợ: 0913625637</h5>
                </div>
                <div class="col-6" style="text-align:right">
                        <h5>' . $formattedDate . '</h5>
                </div>
            </div>
        </div>
        
        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0" style="font-size: 24px;margin: auto; text-align:center;">THÔNG TIN ĐƠN HÀNG</h6>
            </div>
            <div class="table-responsive" style="margin: 20px 0px;">
                <table class="table text-start align-middle table-bordered table-hover mb-0 table-styling">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Mã đơn</th>
                            <th scope="col">Thời gian đặt</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>';

        $output .= '    
                        <tr style="text-align: center;">
                            <td>' . $order->shipping_id . '</td>
                            <td>' . $order->created_at . '</td>
                            <td>' . $order->shipping_phone . '</td>
                            <td>' . $order->shipping_name . '</td>
                            <td>' . $order->shipping_address . '</td>
                        </tr>
                        </tbody>
                </table>
            </div>';



        $output .= '
        
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0" style="font-size: 24px;margin: auto; text-align:center;">CHI TIẾT ĐƠN HÀNG</h6>
            </div>
            <div class="table-responsive" style="margin: 20px 0px;">
                <table class="table text-start align-middle table-bordered table-hover mb-0 table-styling">
                    <thead>
                        <tr class="text-white">
                            <th width="100px" scope="col">STT</th>
                            <th width="200px" scope="col">TÊN SẢN PHẨM</th>
                            <th scope="col">SỐ LƯỢNG</th>
                            <th width="150px" scope="col">GIÁ TIỀN</th>
                            <th width="150px" scope="col">TỔNG TIỀN</th>
                        </tr>
                    </thead>';
        $output .= '<tbody>';
        $counter = 1;
        foreach ($order_details_product as $product) {
            // $imageData = json_decode($product->image);
            // $imgPath = asset('storage/storage/avatar/' . $imageData->img);
            $output .= '    
                        <tr style="text-align: center;">
                            <td> ' . $counter . ' </td>
                            <td>' . $data['product_names'][$counter - 1] . '</td>
                            <td> ' . $product->quantity . ' </td>
                            <td>' . number_format($product->price, 0, ',', '.') . ' VNĐ</td>
                            <td>' . number_format($product->price * $product->quantity, 0, ',', '.') . ' VNĐ</td>
                        </tr>';
            $counter++;
        }
        $output .= '
                        <tr>
                            <td colspan="3">
                                <h6 class="mb-0" style="font-size: 16px;margin: auto; text-align:center;margin: 10px 0px;">
                                    Tổng cộng
                                </h6>
                            </td>
                            <td colspan="2">
                                <h6 class="mb-0" style="font-size: 16px;margin: auto; text-align:center;margin: 10px 0px;">
                                    ' . number_format(floatval(str_replace(',', '', $order->shipping_total)), 0, ',', '.') . ' VNĐ
                                </h6>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>';
        $output .= '
                <div class="table-responsive" style="margin: 20px 0px;">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white">
                                <th width="200px" scope="col">Người lập phiếu</th>
                                <th width="800px" scope="col">Người nhận</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>';
        return $output;
    }

    // Hàm đếm số lượng sản phẩm được bán
    public function countSoldProducts()
    {
        $totalSoldProducts = DB::table('lv_shipping_details')->sum('quantity');
        return $totalSoldProducts;
    }

    public function sendMail($id)
    {
        $order = Order::with('orderDetail')->find($id);
        // Gửi email
        // dd($order->orderDetail);
        Mail::to($order->shipping_email)->send(new OrderShipped($order));
        return redirect()->back()->with('success', 'Email đã được gửi thành công.');
    }
}
