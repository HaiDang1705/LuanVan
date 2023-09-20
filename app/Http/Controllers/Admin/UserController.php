<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Users;

class UserController extends Controller
{
    public function getAccountUser()
    {
        $data['accountlist'] = Users::all();
        return view('admin.quanly_taikhoan_khachhang', $data);
    }

    // Xóa tài khoản USER trong Admin
    public function getDeleteAccountUser($id)
    {
        Users::destroy($id);
        return back();
    }

    public function getUser()
    {
        $data['accountlist'] = Users::all();
        return view('admin.thongtin_khachhang', $data);
    }
}