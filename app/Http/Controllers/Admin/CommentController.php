<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// SU dung model Comment
use App\Models\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    // Hiển thị bình luận
    public function getComment()
    {
        // lay tat ca du lieu trong Comment
        // $data['commentlist'] = Comment::all();
        $data['commentlist'] = DB::table('lv_binhluan')
            ->join('lv_product', 'lv_binhluan.bl_product_id', '=', 'lv_product.product_id')
            ->orderBy('lv_binhluan.bl_id', 'asc')
            ->get();
        // $product['listproduct'] = DB::table('lv_product')
        //     ->join('lv_category', 'lv_product.product_cate', '=', 'lv_category.cate_id')
        //     ->orderBy('lv_product.product_id', 'asc')
        //     ->get();
        return view('admin.quanly_binhluan', $data);
    }

    // Xóa bình luận
    public function getDeleteComment($id)
    {
        Comment::destroy($id);
        return back();
    }
}