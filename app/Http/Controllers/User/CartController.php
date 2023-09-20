<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Product;
use \Gloudemans\Shoppingcart\Facades\Cart;
// use \Hardevine\Shoppingcart\Facades\Cart;
// use Cart;

class CartController extends Controller
{
    public function getAddCart($id){
        $product = Product::find($id);
        Cart::add(['id' => $id, 'name' => $product->product_name, 'qty' => 1, 'price' => $product->product_price, 'options' => ['img' => $product->product_image]]);
        return redirect('user/cart/show');
        // $data = Cart::content();
        // dd($data);
    }

    public function getShowCart(){
        $data['total'] = Cart::total();
        $data['products'] = Cart::content();
        return view('user.cart', $data);
    }

    public function getDeleteCart($id){
            Cart::remove($id);
        return back();
    }

    public function  getUpdateCart(Request $request){
        Cart::update($request->rowId,$request->qty);
    }

    // public function postComplete(Request $request){
    //     $data['info'] = $request->all();
    //     $email = $request->email;
    //     $data['cart'] = Cart::content();
    //     $data['total'] = Cart::total();
    //     Mail::send('frontend.email', $data, function($message) use ($email){
    //         $message->from('dangnguyen1705@gmail.com', 'HD STORE');   
    //         $message->to($email, $email);   
    //         $message->cc('dangb1909900@student.ctu.edu.vn', 'Hai Dang');   
    //         $message->subject('Thông báo xác nhận đơn hàng HD.STORE');   
    //     });
    //     Cart::destroy();
    //     return redirect('complete');
    // }

    // public function getComplete(){
    //     return view('user.xacnhan');
    // }
}
