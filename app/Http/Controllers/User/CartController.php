<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Product;
use App\Models\Models\Order;
use App\Models\Models\Payment;
use App\Models\Models\CartItem;
use App\Models\Models\OrderDetail;
use App\Models\Models\Shipping_Status;
use App\Models\Models\Shipping_States;
use App\Models\Models\CustomerInfor;
use App\Models\Models\NhapKhoDetails;
use App\Models\Models\ProductQuantity;
use Carbon\Carbon;
use Exception;
use \Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

// use \Hardevine\Shoppingcart\Facades\Cart;
// use Cart;

class CartController extends Controller
{
    public function getAddCart($id)
    {
        $product = Product::find($id);

        if (Auth::guard('customer')->check()) {
            $customerID = auth::guard('customer')->user()->id;
            $existingCartItem = CartItem::where('id_customer', $customerID)
                ->where('id_product', $id)
                ->first();

            if ($existingCartItem) {
                // Tăng số lượng sản phẩm trong giỏ hàng hiện có
                $existingCartItem->quantity += 1;
                $existingCartItem->save();
            } else {
                // Tạo bản ghi mới trong bảng cart_items
                CartItem::create([
                    'id_customer' => $customerID,
                    'id_product' => $id,
                    'quantity' => 1,
                    'price' => $product->product_price,
                    'image' => $product->product_image,
                    // Các trường khác bạn muốn lưu vào bảng cart_items
                ]);
            }

            // Đã đăng nhập, chuyển hướng đến route với ID
            return redirect()->route('cart.show', ['id' => auth()->guard('customer')->user()->id]);
        } else {
            // Người dùng chưa đăng nhập, sử dụng Cart để thêm sản phẩm vào giỏ hàng
            //START - Hiển thị sản phẩm trong Cart
            $cartItem = [
                'id' => $id,
                'name' => $product->product_name,
                'qty' => 1,
                'price' => $product->product_price,
                'options' => ['img' => $product->product_image]
            ];

            Cart::add($cartItem);
            //END

            // Chưa đăng nhập, chuyển hướng đến route mà không có ID
            return redirect('user/cart/show');
        }
    }

    public function getShowCart($id = null)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            $data['total'] = 0; // Khởi tạo tổng giá trị ban đầu
            $data['totalProfitOneOrder'] = 0; // Khởi tạo tổng lợi nhuận của một đơn hàng ban đầu
            $data['count'] = CartItem::where('id_customer', $customer->id)->sum('quantity'); // đếm quantity trong CartItem dựa trên id_customer
            // $data['products'] = CartItem::where('id_customer', $customer->id)->get();
            $data['products'] = CartItem::where('id_customer', $customer->id)->with('product')->get();
            // dd($data['products']);
            $data['liststatus'] = Shipping_Status::all();
            $data['liststates'] = Shipping_States::all();
            $data['customer'] = $customer;

            // Tính tổng giá trị từ lv_cart
            foreach ($data['products'] as $product) {
                $data['total'] += $product->price * $product->quantity;

                // Lấy thông tin giá nhập từ bảng lv_nhapkho_details
                $nhapkhoDetail = NhapKhoDetails::where('product_id', $product->id_product)
                    ->first();
                if ($nhapkhoDetail) {
                    // Tính lợi nhuận của từng sản phẩm trong đơn hàng
                    $profitPerProduct = ($product->price - $nhapkhoDetail->price) * $product->quantity;

                    // Cộng vào tổng lợi nhuận của đơn hàng
                    $data['totalProfitOneOrder'] += $profitPerProduct;
                }
            }
            // dd($data['totalProfitOneOrder']);    

            // Truy vấn địa chỉ và số điện thoại từ bảng lv_customers_infor nếu có id được truyền
            if ($id) {
                // $data['customerinfo']
                $data['customerinfo'] = CustomerInfor::where('id_customer', $id)->first();

                // Đảm bảo rằng bạn đã truy vấn thành công dữ liệu
                // if ($data['customerinfo']) {
                if ($data['customerinfo']) {
                    $data['address'] = $data['customerinfo']->address;
                    $data['phone'] = $data['customerinfo']->phone;
                } else {
                    $data['address'] = null;
                    $data['phone'] = null;
                }
            } else {
                $data['address'] = null;
                $data['phone'] = null;
            }
        } else {
            $data['total'] = intVal(Cart::total()) * 1000;
            // $data['total'] = Cart::total();
            $data['products'] = Cart::content();
            $data['liststatus'] = Shipping_Status::all();
            $data['liststates'] = Shipping_States::all();
            $data['customer'] = null;
            $data['address'] = null;
            $data['phone'] = null;
            $data['totalProfitOneOrder'] = 0; // Khởi tạo tổng lợi nhuận của một đơn hàng ban đầu
            // Tính tổng lợi nhuận từ Cart
            foreach ($data['products'] as $product) {
                // Lấy thông tin giá nhập từ bảng lv_nhapkho_details
                $nhapkhoDetail = NhapKhoDetails::where('product_id', $product->id)
                    ->first();
                if ($nhapkhoDetail) {
                    // Tính lợi nhuận của từng sản phẩm trong đơn hàng
                    $profitPerProduct = ($product->price - $nhapkhoDetail->price) * $product->qty;

                    // Cộng vào tổng lợi nhuận của đơn hàng
                    $data['totalProfitOneOrder'] += $profitPerProduct;
                }
            }
        }
        return view('user.cart', $data);
    }

    public function getDeleteCart($id)
    {
        if (Auth::guard('customer')->check()) {
            CartItem::destroy($id);
            Session::flash('success', 'Bạn đã xóa sản phẩm thành công');
        } else {
            Cart::remove($id);
            Session::flash('success', 'Bạn đã xóa sản phẩm thành công');
        }
        return back();
    }

    public function getUpdateCart(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            // Nếu đã đăng nhập, sử dụng lv_cart
            $cartItem = CartItem::find($request->rowId);
            if ($cartItem) {
                $cartItem->quantity = $request->qty;
                $cartItem->save();
            }
        } else {
            Cart::update($request->rowId, $request->qty);
        }
    }

    // Gửi đơn hàng
    public function postShipping(Request $request)
    {
        // dd($request->all());
        // Kiểm tra phương thức thanh toán
        // Nếu bạn sử dụng phương thức thanh toán trực tuyến
        $paymentMethod = $request->input('status');

        // Kiểm tra nếu là Thanh toán online
        if ($paymentMethod == 2) {
            $order = new Order;
            $order->shipping_name = $request->name;
            $order->shipping_email = $request->email;
            $order->shipping_phone = $request->phone;
            $order->shipping_address = $request->address;
            $order->shipping_description = $request->description;
            $order->shipping_status = $request->status;
            $order->shipping_states = $request->states;
            $order->shipping_slug = $request->product_slug;
            $order->shipping_total = $request->product_total;
            $order->shipping_profit = $request->product_profit;
            if (Auth::guard('customer')->check()) {
                // Người dùng đã đăng nhập, bạn có thể sử dụng thông tin của họ ở đây
                $customer = Auth::guard('customer')->user();
                $order->id_customer = $customer->id;

                // Xử lý biến $request->product_total nếu đã đăng nhập
                $order->shipping_total = (float) str_replace(',', '', $request->product_total);
                $order->shipping_profit = (float) str_replace(',', '', $request->product_profit);
            } else {
                $order->id_customer = null;
                $order->shipping_total = (int) $request->product_total;
                $order->shipping_profit = (int) $request->product_profit;
            }

            // Lưu chi tiết đơn hàng (sản phẩm từ giỏ hàng) vào bảng OrderDetail
            if (Auth::guard('customer')->check()) {
                $cartItems = CartItem::where('id_customer', $customer->id)->get();
            } else {
                $cartItems = Cart::content();
            }
            $order->save();

            if (Auth::guard('customer')->check()) {
                // Người dùng đã đăng nhập, bạn có thể sử dụng thông tin của họ ở đây
                $customer = Auth::guard('customer')->user();
                $order->id_customer = $customer->id;

                // Xử lý biến $request->product_total nếu đã đăng nhập
                $order->shipping_total = (float) str_replace(',', '', $request->product_total);
                $order->shipping_profit = (float) str_replace(',', '', $request->product_profit);
            } else {
                $order->id_customer = null;
                $order->shipping_total = (int) $request->product_total;
                $order->shipping_profit = (int) $request->product_profit;
            }

            // Lưu chi tiết đơn hàng (sản phẩm từ giỏ hàng) vào bảng OrderDetail
            if (Auth::guard('customer')->check()) {
                $cartItems = CartItem::where('id_customer', $customer->id)->get();
            } else {
                $cartItems = Cart::content();
            }

            $hasError = false; // Biến cờ để kiểm tra lỗi

            foreach ($cartItems as $cartItem) {
                $orderDetail = new OrderDetail;
                $orderDetail->shipping_id = $order->shipping_id;

                // Xử lý dữ liệu sản phẩm nếu không đúng định dạng
                $productData = json_decode($cartItem->options);

                if ($productData && isset($productData->img)) {
                    $orderDetail->image = json_encode(["img" => $productData->img]);
                } else {
                    $orderDetail->image = json_encode(["img" => $cartItem->image]);
                }

                if (Auth::guard('customer')->check()) {
                    $orderDetail->shipping_details_product_id = $cartItem->id_product;
                    $orderDetail->quantity = $cartItem->quantity;
                    $orderDetail->price = $cartItem->price;
                } else {
                    $orderDetail->shipping_details_product_id = $cartItem->id;
                    $orderDetail->quantity = $cartItem->qty;
                    $orderDetail->price = $cartItem->price;
                }

                // Kiểm tra số lượng sản phẩm có sẵn trong kho
                $productId = $orderDetail->shipping_details_product_id;
                $productQuantity = ProductQuantity::where('product_id', $productId)->value('product_quantity');

                if ($orderDetail->quantity > $productQuantity) {
                    // Số lượng sản phẩm trong giỏ hàng vượt quá số lượng có sẵn trong kho
                    Session::flash('error', 'Sản phẩm bạn đặt hiện không có đủ trong kho. Chúng tôi rất xin lỗi bạn.');
                    $hasError = true; // Đặt biến cờ để báo có lỗi
                    break; // Thoát khỏi vòng lặp
                    // return redirect()->back();
                } else {
                    // Giảm số lượng sản phẩm trong bảng lv_product_quantities
                    ProductQuantity::where('product_id', $productId)
                        ->decrement('product_quantity', $orderDetail->quantity);
                    // Lưu chi tiết đơn hàng vào cơ sở dữ liệu
                    $orderDetail->save();
                }
            }

            if (!$hasError) {
                // Nếu không có lỗi, lưu đơn hàng
                $order->save();
            } else {
                $order->destroy($order->shipping_id);
            }

            if (!$hasError) {
                // Xóa giỏ hàng sau khi lưu đơn hàng
                if (Auth::guard('customer')->check()) {
                    CartItem::where('id_customer', $customer->id)->delete();
                } else {
                    Cart::destroy();
                }
                // Lưu thông tin vào session
                session(['order' => $order]);
                session(['orderDetail' => $orderDetail]);
                session(['cartItems' => $cartItems]);
                // dd($order);
                // dd(session(['order' => $order]));


                //xóa đơn hàng order sau khi đã dùng session
                $order->destroy($order->shipping_id);

                $data['donhang'] = $order->shipping_id;
                $data['tongtien'] = $order->shipping_total;

                return view('vnpay.index', $data);
            } else {
                // Nếu có lỗi, không lưu đơn hàng và chuyển hướng trở lại
                return redirect()->back();
            }

            // // Lưu thông tin vào session
            // session(['order' => $order]);
            // session(['orderDetail' => $orderDetail]);
            // session(['cartItems' => $cartItems]);

            // $data['donhang'] = $order->shipping_id;
            // $data['tongtien'] = $order->shipping_total;

            // return view('vnpay.index', $data);
            // // Nếu bạn sử dụng phương thức thanh toán trực tuyến, hãy chuyển hướng đến trang thanh toán
            // $redirectUrl = $this->getPay($request);
            // // dd($redirectUrl);

            // return redirect()->to($redirectUrl); // Chuyển hướng đến trang thanh toán
        }
        // Thanh toán khi nhận hàng
        else {
            $order = new Order;
            $order->shipping_name = $request->name;
            $order->shipping_email = $request->email;
            $order->shipping_phone = $request->phone;
            $order->shipping_address = $request->address;
            $order->shipping_description = $request->description;
            $order->shipping_status = $request->status;
            $order->shipping_states = $request->states;
            $order->shipping_slug = $request->product_slug;
            $order->shipping_total = $request->product_total;
            $order->shipping_profit = $request->product_profit;

            $order->save();

            if (Auth::guard('customer')->check()) {
                // Người dùng đã đăng nhập, bạn có thể sử dụng thông tin của họ ở đây
                $customer = Auth::guard('customer')->user();
                $order->id_customer = $customer->id;

                // Xử lý biến $request->product_total nếu đã đăng nhập
                $order->shipping_total = (float) str_replace(',', '', $request->product_total);
                $order->shipping_profit = (float) str_replace(',', '', $request->product_profit);
            } else {
                $order->id_customer = null;
                $order->shipping_total = (int) $request->product_total;
                $order->shipping_profit = (int) $request->product_profit;
            }

            // Lưu chi tiết đơn hàng (sản phẩm từ giỏ hàng) vào bảng OrderDetail
            if (Auth::guard('customer')->check()) {
                $cartItems = CartItem::where('id_customer', $customer->id)->get();
            } else {
                $cartItems = Cart::content();
            }

            $hasError = false; // Biến cờ để kiểm tra lỗi

            foreach ($cartItems as $cartItem) {
                $orderDetail = new OrderDetail;
                $orderDetail->shipping_id = $order->shipping_id;

                // Xử lý dữ liệu sản phẩm nếu không đúng định dạng
                $productData = json_decode($cartItem->options);

                if ($productData && isset($productData->img)) {
                    $orderDetail->image = json_encode(["img" => $productData->img]);
                } else {
                    $orderDetail->image = json_encode(["img" => $cartItem->image]);
                }

                if (Auth::guard('customer')->check()) {
                    $orderDetail->shipping_details_product_id = $cartItem->id_product;
                    $orderDetail->quantity = $cartItem->quantity;
                    $orderDetail->price = $cartItem->price;
                } else {
                    $orderDetail->shipping_details_product_id = $cartItem->id;
                    $orderDetail->quantity = $cartItem->qty;
                    $orderDetail->price = $cartItem->price;
                }

                // Kiểm tra số lượng sản phẩm có sẵn trong kho
                $productId = $orderDetail->shipping_details_product_id;
                $productQuantity = ProductQuantity::where('product_id', $productId)->value('product_quantity');

                if ($orderDetail->quantity > $productQuantity) {
                    // Số lượng sản phẩm trong giỏ hàng vượt quá số lượng có sẵn trong kho
                    Session::flash('error', 'Sản phẩm bạn đặt hiện không có đủ trong kho. Chúng tôi rất xin lỗi bạn.');
                    $hasError = true; // Đặt biến cờ để báo có lỗi
                    break; // Thoát khỏi vòng lặp
                    // return redirect()->back();
                } else {
                    // Giảm số lượng sản phẩm trong bảng lv_product_quantities
                    ProductQuantity::where('product_id', $productId)
                        ->decrement('product_quantity', $orderDetail->quantity);
                    // Lưu chi tiết đơn hàng vào cơ sở dữ liệu
                    $orderDetail->save();
                }
            }
            // dd($cartItems);
            // dd($order);
            // dd($orderDetail);

            if (!$hasError) {
                // Nếu không có lỗi, lưu đơn hàng
                $order->save();
            } else {
                $order->destroy($order->shipping_id);
            }

            if (!$hasError) {
                // Xóa giỏ hàng sau khi lưu đơn hàng
                if (Auth::guard('customer')->check()) {
                    CartItem::where('id_customer', $customer->id)->delete();
                } else {
                    Cart::destroy();
                }
                return back()->with('success', 'Đơn hàng đã được đặt thành công');
            } else {
                // Nếu có lỗi, không lưu đơn hàng và chuyển hướng trở lại
                return redirect()->back();
            }
        }
    }

    // Hàm hiển thị chi tiết đơn hàng
    public function getBuyHistory($id)
    {
        // Lấy ra đơn hàng có id của user

        // Truy vấn CSDL để lấy lịch sử mua hàng của khách hàng có id_customer là $id
        $customer = Auth::guard('customer')->user();
        $buyHistory = Order::where('id_customer', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $count = CartItem::where('id_customer', $customer->id)->sum('quantity'); // đếm quantity trong CartItem dựa trên id_customer

        // Trả về view hiển thị lịch sử mua hàng và truyền biến $buyHistory vào view
        return view('user.buy-history', ['buyHistory' => $buyHistory, 'customer' => $customer, 'count' => $count]);
    }

    // Hàm hiển thị chi tiết sản phẩm trong từng đơn hàng dựa vào $order_id
    public function getCartHistory($order_id)
    {
        $customer = Auth::guard('customer')->user();
        $count = CartItem::where('id_customer', $customer->id)->sum('quantity'); // đếm quantity trong CartItem dựa trên id_customer

        // Lấy đơn hàng dựa trên ID của đơn hàng và ID của khách hàng
        $order = Order::where('shipping_id', $order_id)
            ->where('id_customer', $customer->id)
            ->first();

        // Kiểm tra xem đơn hàng có tồn tại không
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
        }

        // Lấy danh sách sản phẩm trong đơn hàng
        $orderDetails = OrderDetail::where('shipping_id', $order_id)->get();

        // Trả về view hiển thị lịch sử mua hàng và truyền biến $cartHistory vào view
        // return view('user.cart-history', ['cartHistory' => $cartHistory, 'customer' => $customer, 'count' => $count]);
        return view('user.cart-history', ['order' => $order, 'orderDetails' => $orderDetails, 'customer' => $customer, 'count' => $count]);
    }

    // Hàm hủy đơn hàng
    public function cancelOrder($id)
    {
        $customer = Auth::guard('customer')->user();

        // Kiểm tra xem đơn hàng có tồn tại và thuộc về khách hàng đang đăng nhập không
        $order = Order::where('shipping_id', $id)
            ->where('id_customer', $customer->id)
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
        }

        // Lấy danh sách chi tiết đơn hàng
        $orderDetails = OrderDetail::where('shipping_id', $id)->get();

        foreach ($orderDetails as $orderDetail) {
            $productId = $orderDetail->shipping_details_product_id;
            $quantityPurchased = $orderDetail->quantity;

            // Cộng lại số lượng vào bảng lv_product_quantities
            $productQuantity = ProductQuantity::where('product_id', $productId)->first();
            $productQuantity->product_quantity += $quantityPurchased;
            $productQuantity->save();
        }

        // Xóa đơn hàng
        Order::destroy($id);

        return redirect()->back()->with('success', 'Đơn hàng đã hủy thành công');
    }

    // Hiển thị trang thanh toán online
    public function getPay(Request $request)
    {
        $data = $request->all();
        $donhang = $request->input('donhang');
        $tongtien = $request->input('tongtien');
        // dd($tongtien);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/user/cart/vnpay/return";
        $vnp_TmnCode = "KG8WEFBX"; //Mã website tại VNPAY 
        $vnp_HashSecret = "NPQSIUGREPWATOSLQEXQEMSDUEQHYEXB"; //Chuỗi bí mật

        // $vnp_TxnRef = '1234'; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY

        // $vnp_TxnRef = uniqid(); // Sử dụng hàm uniqid() để tạo một giá trị ngẫu nhiên
        $vnp_TxnRef = $donhang; // Sử dụng hàm uniqid() để tạo một giá trị ngẫu nhiên
        $vnp_OrderInfo = 'Thanh toán đơn hàng test';
        $vnp_OrderType = 'Truc Tien Store';
        // $vnp_Amount = $data['product_total'] * 100;
        $vnp_Amount = $tongtien * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // $returnData = array(
        //     'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        // );

        // // dd($data);
        // if (isset($_POST['redirect'])) {
        //     header('Location: ' . $vnp_Url);
        //     die();
        // } else {
        // echo json_encode($returnData);
        return $vnp_Url; // Trả về URL để chuyển hướng
        // }
    }

    public function createPayment(Request $request)
    {

        // dd($request->all());
        session(['order_desc' => $request->order_desc]);
        // dd($request->order_desc);
        // // Nếu bạn sử dụng phương thức thanh toán trực tuyến, hãy chuyển hướng đến trang thanh toán
        $redirectUrl = $this->getPay($request);
        // dd($redirectUrl);

        return redirect()->to($redirectUrl); // Chuyển hướng đến trang thanh toán
    }

    public function vnpayReturn(Request $request)
    {
        // Lấy thông tin đơn hàng và chi tiết đơn hàng từ session
        $order = session('order');
        $order_desc = session('order_desc');
        $orderDetail = session('orderDetail');
        $cartItems = session('cartItems');

        // ---------------------------------------------------
        $order1 = $order;
        $orderDetail1 = $orderDetail;
        // ---------------------------------------------------
        $vnpayData = $request->all();
        // dd($order1);
        // dd($orderDetail1);
        // dd($vnpayData);
        // dd($cartItems);
        // dd($orderDetails);
        if ($request->vnp_ResponseCode == '00') {
            // Lưu thông tin thanh toán
            $payment = new Payment;
            $payment->p_transaction_id = $request->input('vnp_TxnRef');
            // Kiểm tra nếu 'id_customer' tồn tại trong $order thì gán nó cho 'p_user_id', ngược lại gán null
            $payment->p_user_id = $order->id_customer ?? null;
            $payment->p_note = $order_desc;
            $payment->p_money = $order->shipping_total;
            $payment->p_vnp_response_code = $request->input('vnp_ResponseCode');
            $payment->p_code_vnpay = $request->input('vnp_TransactionNo');
            $payment->p_code_bank = $request->input('vnp_BankCode');
            $payment->p_time = now(); // Thời gian chuyển khoản, bạn có thể thay đổi thời gian tùy theo dữ liệu bạn có
            $payment->save(); // Lưu thông tin thanh toán

            $newPaymentId = $payment->p_transaction_id - 1;
            $payment->p_transaction_id = $newPaymentId;
            $payment->save(); // Lưu thông tin thanh toán

            // Lưu lại thông tin order và orDetails dựa vào session 
            // $order = session('order') và $orderDetail = session('orderDetail')
            // Tạo một đối tượng Shipping
            $shipping = new Order;
            $shipping->shipping_name = $order1->shipping_name;
            $shipping->shipping_email = $order1->shipping_email;
            $shipping->shipping_phone = $order1->shipping_phone;
            $shipping->shipping_address = $order1->shipping_address;
            $shipping->shipping_slug = $order1->shipping_slug;
            $shipping->shipping_total = $order1->shipping_total;
            $shipping->shipping_profit = $order1->shipping_profit;
            $shipping->shipping_status = $order1->shipping_status;
            $shipping->shipping_states = $order1->shipping_states;
            $shipping->id_customer = $order1->id_customer;
            // Lưu đối tượng Shipping vào cơ sở dữ liệu
            $shipping->save();
            // dd($shipping);

            // $newShippingId = $shipping->shipping_id - 1;
            // $shipping->shipping_id = $newShippingId;

            $shipping->shipping_id = $payment->p_transaction_id;
            // dd($shipping);
            $shipping->save();

            // Lấy shipping_id sau khi đã lưu vào cơ sở dữ liệu
            // Gán shipping_id của đơn hàng cho đối tượng Shipping
            // $shipping->shipping_id = $order1->shipping_id;
            // Lưu lại đối tượng Shipping sau khi cập nhật shipping_id
            // $shipping->save();
            // dd($shipping);
            // dd($cartItems);

            foreach ($cartItems as $cartItem) {
                $orderDetail = new OrderDetail;
                $orderDetail->shipping_id = $shipping->shipping_id;

                // Xử lý dữ liệu sản phẩm nếu không đúng định dạng
                $productData = json_decode($cartItem->options);

                if ($productData && isset($productData->img)) {
                    $orderDetail->image = json_encode(["img" => $productData->img]);
                } else {
                    $orderDetail->image = json_encode(["img" => $cartItem->image]);
                }

                if (Auth::guard('customer')->check()) {
                    $orderDetail->shipping_details_product_id = $cartItem->id_product;
                    $orderDetail->quantity = $cartItem->quantity;
                    $orderDetail->price = $cartItem->price;
                } else {
                    $orderDetail->shipping_details_product_id = $cartItem->id;
                    $orderDetail->quantity = $cartItem->qty;
                    $orderDetail->price = $cartItem->price;
                }

                // Kiểm tra số lượng sản phẩm có sẵn trong kho
                $productId = $orderDetail->shipping_details_product_id;
                $productQuantity = ProductQuantity::where('product_id', $productId)->value('product_quantity');

                if ($orderDetail->quantity > $productQuantity) {
                    // Xử lý khi có lỗi, ví dụ: thông báo lỗi và/hoặc redirect
                    // Session::flash('error', 'Sản phẩm bạn đặt hiện không có đủ trong kho. Chúng tôi rất xin lỗi bạn.');
                    // return redirect()->back();
                } else {
                    // Giảm số lượng sản phẩm trong bảng lv_product_quantities
                    ProductQuantity::where('product_id', $productId)
                        ->decrement('product_quantity', $orderDetail->quantity);
                    // Lưu chi tiết đơn hàng vào cơ sở dữ liệu
                    $orderDetail->save();
                }
            }

            Session::flash('success', 'Bạn đã đặt hàng và thanh toán thành công');
            // dd($orderDetail);
            // dd($payment);
            // dd($shipping);

            return view('vnpay.vnpay_return', compact('vnpayData'));
            // return redirect()->route('cart.show')->with('success', 'Bạn đã đặt hàng và thanh toán thành công');
        } else {
            // Session::flash('error', 'Đã xảy ra lỗi không thể thanh toán đơn hàng');
            Order::where('shipping_id', $order->shipping_id)->delete();
            return redirect()->route('cart.show')->with('error', 'Đã xảy ra lỗi không thể thanh toán đơn hàng');
        }
    }
}
