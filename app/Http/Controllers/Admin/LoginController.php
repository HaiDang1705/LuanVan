<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

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
        if (Auth::attempt($arr)) {
            $user = Auth::user();
            session(['user_role' => $user->role]);
            if ($user->role === 2) {
                return redirect()->intended('admin/index');
            } else {
                Auth::logout();
                return back()->withInput()->with('error', 'Tài khoản không có quyền truy cập.');
                // return redirect()->intended('user/index');
            }
        } else {
            return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu chưa đúng');
        }

        // $email = $request->email;
        // $password = $request->password;
        // // Tìm người dùng với email và mật khẩu
        // $user = DB::table('lv_users')
        //             ->where('email',$email)
        //             // ->where('password', $password)
        //             ->first();
        // if($user && Hash::check($password, $user->password)) {
        // // Lưu vai trò của người dùng vào session
        //     session(['role' => $user->role]);
        //     if($user->role == 1) {
        //         return redirect()->intended('user/index');
        //     }
        //      else {
        //          return redirect()->intended('admin/index');
        //      }
        // }
        // else {
        //     return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không chính xác.');
        // }
    }
}
