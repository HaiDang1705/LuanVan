<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    //
    public function getLogin()
    {
        return view('admin.signin');
    }

    public function postLogin(Request $request)
    {
        $arr = ['email' => $request->email, 'password' => $request->password];
        if(Auth::attempt($arr)){
            $user = Auth::user();
            session(['user_role' => $user->role]);
            if($user->role === 2) {
                return redirect()->intended('admin/index');
            } else{
                Auth::logout();
                return back()->withInput()->with('error','Tài khoản không có quyền truy cập.');
                // return redirect()->intended('user/index');
            }
        } else{
            return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu chưa đúng');
        }
    }
}
