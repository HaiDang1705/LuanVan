<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Post;
use App\Models\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getHome()
    {
        $data['post_views'] = Post::orderBy('post_view','DESC')->take(10)->get();
        $data['product_views'] = Product::orderBy('product_view','DESC')->take(10)->get();
        return view('admin.index', $data);
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect()->intended('login');

        // session()->forget('user_role'); // Xóa vai trò người dùng khỏi session
        // return redirect()->intended('login');
    }

    public function getStatistic()
    {

    }
}
