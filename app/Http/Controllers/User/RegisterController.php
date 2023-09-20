<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Users;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AddAccountUserRequest;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('user.register');
    }

    public function postRegister(AddAccountUserRequest $request)
    {
        $accountUser = new Users;
        $accountUser->user_name = $request->name;
        $accountUser->user_address = $request->address;
        $accountUser->user_phone = $request->phone;
        $accountUser->user_email = $request->email;
        $accountUser->user_password = bcrypt($request->password);
        $accountUser->save();

        // Lưu thông báo thành công vào Session
        Session::flash('success', 'Bạn đã đăng ký thành công');
        
        return back();
    }
}
