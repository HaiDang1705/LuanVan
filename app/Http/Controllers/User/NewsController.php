<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function getNews()
    {
        $data['posts'] = Post::all();
        $customer = Auth::guard('customer')->user();
        $data['customer'] = $customer;
        return view('user.news', $data);
    }

    public function getPost($id)
    {
        $data['post'] = Post::find($id);
        // Lượt xem
        $post = Post::find($id);
        $post->post_view = (int)$post->post_view + 1; // Chuyển đổi thành số nguyên và cộng 1
        $post->save();
        $customer = Auth::guard('customer')->user();
        $data['customer'] = $customer;
        return view('user.post', $data);
    }
}
