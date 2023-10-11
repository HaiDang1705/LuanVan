<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Models\CustomerInfor;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAccountUser()
    {
        $data['userlist'] = Customer::all();
        return view('admin.quanly_taikhoan_khachhang', $data);
    }

    // Xóa tài khoản USER trong Admin
    public function getDeleteAccountUser($id)
    {
        Customer::destroy($id);
        return back();
    }

    public function getUser()
    {
        // $data['userlist'] = CustomerInfor::all();
        $data['userlist'] = DB::table('lv_customers_infor')
            ->join('lv_customers', 'lv_customers_infor.id_customer', '=', 'lv_customers.id')
            ->orderBy('lv_customers_infor.customers_infor_id', 'asc')
            ->get();
        return view('admin.thongtin_khachhang', $data);
    }

    //Hàm đếm số lượng khách hàng có tài khoản:
    public function countCustomer()
    {
        $totalCustomers = Customer::count();
        return $totalCustomers;
    }
}