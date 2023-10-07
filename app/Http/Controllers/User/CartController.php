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
use \Gloudemans\Shoppingcart\Facades\Cart;
// use \Hardevine\Shoppingcart\Facades\Cart;
// use Cart;

class CartController extends Controller
{
    public function getAddCart($id)
    {
        $product = Product::find($id);
        Cart::add([
            'id' => $id,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $product->product_price,
            'options' => ['img' => $product->product_image]
        ]);
        return redirect('user/cart/show');
        // $data = Cart::content();
        // dd($data);
    }

    // public function getAddCart($id)
    // {
    //     $product = Product::find($id);

    //     $cartItem = [
    //         'id' => $id,
    //         'name' => $product->product_name,
    //         'qty' => 1,
    //         'price' => $product->product_price,
    //         'options' => ['img' => $product->product_image]
    //     ];

    //     Cart::add($cartItem);

    //     CartItem::create([
    //         'id_customer' => auth::guard('customer')->user()->id, // Lấy ID của người dùng đã đăng nhập
    //         'id_product' => $id,
    //         'quantity' => 1,
    //         'price' => $product->product_price,
    //         'image' => $product->product_image,
    //         // Các trường khác bạn muốn lưu vào bảng cart_items
    //     ]);

    //     return redirect('user/cart/show');
    //     // $data = Cart::content();
    //     // dd($data);
    // }

    public function getShowCart()
    {
        $data['total'] = Cart::total();
        $data['products'] = Cart::content();
        $data['liststatus'] = Shipping_Status::all();
        $data['liststates'] = Shipping_States::all();
        $customer = Auth::guard('customer')->user();
        $data['customer'] = $customer;
        return view('user.cart', $data);
    }

    public function getDeleteCart($id)
    {
        Cart::remove($id);
        return back();
    }

    public function  getUpdateCart(Request $request)
    {
        Cart::update($request->rowId, $request->qty);
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
        $order->shipping_total = $request->product_total;
        $order->save();

        // Lưu chi tiết đơn hàng (sản phẩm từ giỏ hàng) vào bảng OrderDetail
        $cartItems = Cart::content();
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail;
            $orderDetail->shipping_id = $order->shipping_id;
            // $orderDetail->shipping_details_shipping_id = $order->shipping_id;
            $orderDetail->shipping_details_product_id = $cartItem->id;
            $orderDetail->quantity = $cartItem->qty;
            $orderDetail->price = $cartItem->price;
            $orderDetail->image = $cartItem->options;
            $orderDetail->save();
        }


        // Xóa giỏ hàng sau khi lưu đơn hàng
        Cart::destroy();
        return back()->with('success', 'Đơn hàng đã được đặt thành công');
    }
}
