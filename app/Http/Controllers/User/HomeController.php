<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Models\Product;
use App\Models\Models\Category;
use App\Models\Models\Comment;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function getHome()
    {
        $data['listproducts'] = Product::orderBy('product_id','desc')->take(8)->get();
        // $data['listcategories'] = Category::all();
        // $data['listcategories'] = Category::orderBy('cate_id','desc')->get();
        return view('user.index', $data);
    }

    public function getDetail($id)
    {
        $data['listproduct'] = DB::table('lv_product')
            ->join('lv_category', 'lv_product.product_cate', '=', 'lv_category.cate_id')
            ->orderBy('lv_product.product_id', 'asc')
            ->get();
            
        $data['product'] = Product::find($id);
        $data['comments'] = Comment::where('bl_product_id', $id)->get();

        // Lượt xem
        $product = Product::find($id);
        $product->product_view += 1;
        $product->save();

        return view('user.product',$data);
    }

    public function getCategory($id)
    {
        $data['cateName'] = Category::find($id);
        $data['items'] = Product::where('product_cate', $id)->orderBy('product_id','desc')->paginate(8);
        return view('user.category', $data);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->intended('user/login');
    }

    public function getComment()
    {
        // return view('admin.quanly_binhluan');
    }

    public function postComment(Request $request, $id)
    {
        $comment = new Comment;
        $comment->bl_name = $request->name;
        $comment->bl_email = $request->email;
        $comment->bl_content = $request->content;
        $comment->bl_status = $request->status;
        $comment->bl_product_id = $id;
        $comment->save();
        return back();
    }

    // Tìm kiếm sản phẩm theo tên
    public function getSearch(Request $request)
    {
        $result = $request->result;
        $data['keyword'] = $result;
        $result = str_replace(' ','%', $result);
        $data['items'] = Product::where('product_name', 'like', '%'.$result.'%')->get();

        return view('user.search',$data);
    }
}
