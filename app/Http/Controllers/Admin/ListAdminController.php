<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ListAdminController extends Controller
{
    public function getListAdmin()
    {
        $data["adminlist"] = Admin::all();
        return view('admin.danhsach_nhaquantri', $data);
    }
    
}
