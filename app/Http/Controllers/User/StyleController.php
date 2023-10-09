<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StyleController extends Controller
{
    public function getStyleHome()
    {
        $customer = Auth::guard('customer')->user();
        $data['customer'] = $customer;
        if ($customer) {
            $data['count'] = CartItem::where('id_customer', $customer->id)->sum('quantity');
        }
        return view('user.stylehome', $data);
    }
}
