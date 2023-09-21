<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAccountUser()
    {
        $data['userlist'] = User::all();
        return view('admin.quanly_taikhoan_khachhang', $data);
    }

    // Xóa tài khoản USER trong Admin
    public function getDeleteAccountUser($id)
    {
        User::destroy($id);
        return back();
    }

    public function getUser()
    {
        $data['userlist'] = User::all();
        return view('admin.thongtin_khachhang', $data);
    }
}