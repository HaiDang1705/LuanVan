<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ListAdminController extends Controller
{
    public function getListAdmin()
    {
        $data["userlist"] = User::all();
        return view('admin.danhsach_nhaquantri', $data);
    }
    
}
