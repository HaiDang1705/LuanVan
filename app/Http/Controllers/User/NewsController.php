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
        return view('user.news', $data);
    }

    public function getPost($id)
    {
        $data['post'] = Post::find($id);
        return view('user.post', $data);
    }
}
