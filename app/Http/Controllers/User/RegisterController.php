<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
        $accountCustomer = new Customer();
        $accountCustomer->name = $request->name;
        // $user->address = $request->address;
        // $user->phone = $request->phone;
        $accountCustomer->email = $request->email;
        // $user->role = $request->role;
        $accountCustomer->password = bcrypt($request->password);
        $accountCustomer->save();

        // Lưu thông báo thành công vào Session
        Session::flash('success', 'Bạn đã đăng ký thành công');
        
        return back();
    }
}
