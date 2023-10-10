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
use \Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
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
            CartItem::create([
                'id_customer' => auth::guard('customer')->user()->id, // Lấy ID của người dùng đã đăng nhập
                'id_product' => $id,
                'quantity' => 1,
                'price' => $product->product_price,
                'image' => $product->product_image,
                // Các trường khác bạn muốn lưu vào bảng cart_items
            ]);
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
            $data['products'] = CartItem::where('id_customer', $customer->id)->get();
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
            $data['total'] = intval(Cart::total());
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
        } else {
            Cart::remove($id);
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
        $order->shipping_status = $request->status;
        $order->shipping_states = $request->states;
        $order->shipping_slug = $request->product_slug;
        // $order->shipping_total = $request->product_total;

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

        $order->save();

        // Lưu chi tiết đơn hàng (sản phẩm từ giỏ hàng) vào bảng OrderDetail
        if (Auth::guard('customer')->check()) {
            $cartItems = CartItem::where('id_customer', $customer->id)->get();
        } else {
            $cartItems = Cart::content();
        }

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

            // $orderDetail->shipping_details_product_id = $cartItem->id_product;
            // $orderDetail->quantity = $cartItem->quantity;
            // $orderDetail->price = $cartItem->price;
            // $orderDetail->image = $cartItem->image;
            
            // Lưu chi tiết đơn hàng vào cơ sở dữ liệu
            $orderDetail->save();
        }

        // Xóa giỏ hàng sau khi lưu đơn hàng
        if (Auth::guard('customer')->check()) {
            CartItem::where('id_customer', $customer->id)->delete();
        } else {
            Cart::destroy();
        }

        return back()->with('success', 'Đơn hàng đã được đặt thành công');
    }

    public function getCartHistory($id)
    {
        // Truy vấn CSDL để lấy lịch sử mua hàng của khách hàng có id_customer là $id
        $cartHistory = CartItem::where('id_customer', $id)->get();
        $customer = Auth::guard('customer')->user();
        $count = CartItem::where('id_customer', $customer->id)->sum('quantity'); // đếm quantity trong CartItem dựa trên id_customer

        // Trả về view hiển thị lịch sử mua hàng và truyền biến $cartHistory vào view
        return view('user.cart-history', ['cartHistory' => $cartHistory, 'customer' => $customer, 'count' => $count]);
    }
}
