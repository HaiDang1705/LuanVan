<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AddAccountUserRequest;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('admin.signup');
    }

    // public function postRegister()
    public function postRegister(AddAccountUserRequest $request)
    {
        $accountUser = new User;
        $accountUser->name = $request->name;
        $accountUser->email = $request->email;
        $accountUser->role = $request->role;
        $accountUser->password = bcrypt($request->password);
        $accountUser->save();

        // Lưu thông báo thành công vào Session
        Session::flash('success', 'Bạn đã đăng ký thành công');
        
        return back();
    }
}
