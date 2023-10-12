<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Product;
use App\Models\Models\Order;
use App\Models\Models\CartItem;
use App\Models\Models\OrderDetail;
use App\Models\Models\Shipping_Status;
use App\Models\Models\Shipping_States;
use App\Models\Models\CustomerInfor;
use App\Models\Models\ProductQuantity;
use \Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// use \Hardevine\Shoppingcart\Facades\Cart;
// use Cart;

class CartController extends Controller
{
    // public function getAddCart($id)
    // {
    //     $product = Product::find($id);
    //     Cart::add([
    //         'id' => $id,
    //         'name' => $product->product_name,
    //         'qty' => 1,
    //         'price' => $product->product_price,
    //         'options' => ['img' => $product->product_image]
    //     ]);
    //     return redirect('user/cart/show');
    //     // $data = Cart::content();
    //     // dd($data);
    // }

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
            }

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

        // Lưu thông tin đơn hàng trước để có shipping_id
        $order->save();

        if (Auth::guard('customer')->check()) {
            // Người dùng đã đăng nhập, bạn có thể sử dụng thông tin của họ ở đây
            $customer = Auth::guard('customer')->user();
            $order->id_customer = $customer->id;

            // Xử lý biến $request->product_total nếu đã đăng nhập
            $order->shipping_total = (float) str_replace(',', '', $request->product_total);
        } else {
            $order->id_customer = null;
            $order->shipping_total = (int) $request->product_total;
        }

        // Kiểm tra coi có đủ sản phẩm để bán không. Nếu đủ mới lưu order
        // $order->save();

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

            return back()->with('success', 'Đơn hàng đã được đặt thành công');
        } else {
            // Nếu có lỗi, không lưu đơn hàng và chuyển hướng trở lại
            return redirect()->back();
        }

        // Xóa giỏ hàng sau khi lưu đơn hàng
        // if (Auth::guard('customer')->check()) {
        //     CartItem::where('id_customer', $customer->id)->delete();
        // } else {
        //     Cart::destroy();
        // }

        // return back()->with('success', 'Đơn hàng đã được đặt thành công');
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
}
