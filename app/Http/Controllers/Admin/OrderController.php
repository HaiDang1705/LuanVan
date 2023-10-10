<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Order;
use App\Models\Models\OrderCart;
use App\Models\Models\OrderDetail;
use App\Models\Models\Shipping_States;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\App;

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
            body{
                font-family: DejaVu Sans;
            }
            .table-styling{
                border: 1px solid #000;
            }
            .table-styling thead tr th{
                border: 1px solid #000;
            }
            .table-styling tbody tr td{
                border: 1px solid #000;
            }
        </style>
        <h2 style="text-align: center;">Công Ty TNHH MTV Sơn Kim Cương Trúc Tiên</h2>
        <h5>Địa chỉ: 310 Lý Thường Kiệt, Khóm 2, Phường 6, TP Cà Mau</h5>
        <h5>Tổng đài hỗ trợ: 0913625637</h5>
        <h5>' . $formattedDate . '</h5>
        ------------------------------------------------------------------------------------------------------------------------------------
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
                        </tr>';

        $output .= '                            
                    </tbody>
                </table>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0" style="font-size: 24px;margin: auto; text-align:center;">THÔNG TIN NGƯỜI VẬN CHUYỂN</h6>
            </div>
            <div class="table-responsive" style="margin: 20px 0px;">
                <table class="table text-start align-middle table-bordered table-hover mb-0 table-styling">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Tên người vận chuyển</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ghi chú</th>
                            <th scope="col">Hình thức thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>';

        $output .= '    
                    <tr style="text-align: center;">
                            <td>Nguyễn Hải Đăng - chưa</td>
                            <td>Cà Mau - chưa</td>
                            <td>0123456789 - chưa</td>
                            <td>dang@gmail.com - chưa</td>
                            <td>aaaaaaaa - chưa</td>
                            <td>Thanh toán khi nhận hàng - chưa</td>
                        </tr>';

        $output .= '                            
                    </tbody>
                </table>
            </div>
        
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
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0" style="font-size: 16px;margin: auto; text-align:left;margin: 20px 0px;">Tổng cộng: ' . number_format(floatval(str_replace(',', '', $order->shipping_total)), 0, ',', '.') . ' VNĐ</h6>
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
                                <td style="text-align:center">Đăng</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>';
        return $output;
    }
}
