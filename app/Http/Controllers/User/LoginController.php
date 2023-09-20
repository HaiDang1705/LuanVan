<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLoginUser()
    {
        return view('user.login');
    }

    // public function postLoginUser(Request $request)
    // {
    //     $arr = ['user_email' => $request->email, 'user_password' => $request->password];
    //     // if(Auth::attempt($arr)){
    //     if (Auth::guard('useraccount')->attempt($arr)) {
    //         return redirect()->intended('user/index');
    //     } else {
    //         return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu chưa đúng');
    //     }
    // }

    public function postLoginUser(Request $request)
    {

        if (!empty($request->email) && !empty($request->password)) {
            $arr = ['user_email' => $request->email, 'password' => $request->password];
            if (Auth::guard('useraccount')->attempt($arr)) {
                return redirect()->intended('user/cart');
            } else {
                return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu chưa đúng');
            }
        } else {
            return back()->withInput()->with('error', 'Vui lòng nhập đầy đủ thông tin đăng nhập');
        }
    }
    
}
