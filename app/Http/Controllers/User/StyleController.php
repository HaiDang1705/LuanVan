<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StyleController extends Controller
{
    public function getStyleHome()
    {
        $customer = Auth::guard('customer')->user();
        $data['customer'] = $customer;
        return view('user.stylehome', $data);
    }
}
