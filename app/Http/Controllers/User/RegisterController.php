<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\Models\Users;
use App\Models\User;
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
        $user = new User;
        $user->name = $request->name;
        // $user->address = $request->address;
        // $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();

        // Lưu thông báo thành công vào Session
        Session::flash('success', 'Bạn đã đăng ký thành công');
        
        return back();
    }
}
