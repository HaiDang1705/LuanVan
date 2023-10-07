<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            // Xác thực thành công cho guard "customer"
            return redirect()->intended('user/index'); // Điều hướng đến trang khách hàng sau khi đăng nhập thành công
        } else {
            return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu chưa đúng');
        }
    }
}
