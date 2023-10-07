<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPostRequest;
use Illuminate\Http\Request;
use App\Models\Models\Post;
use Illuminate\Support\Str;

class BaiDangController extends Controller
{
    // Hiển thị bài đăng
    public function getBaiDang()
    {
        $data['listpost'] = Post::all();
        return view('admin.quanly_baidang',$data);
    }

    // Đăng bài
    public function getAddBaiDang()
    {
        return view('admin.add_baidang');
    }
    public function postAddBaiDang(AddPostRequest $request)
    {
        $filename = $request->image->getClientOriginalName();
        $post = new Post();
        $post->post_name = $request->name;
        $post->post_status = $request->status;
        $post->post_slug = str::slug($request->name);
        $post->post_nguoidang = $request->poster;
        $post->post_mota = $request->description;
        $post->post_image = $filename;
        
        $post->save();
        $request->image->storeAs('public/storage/post', $filename);
        return back();
    }
    // Sửa bài
    public function getEditBaiDang($id)
    {
        $data['post'] = Post::find($id);
        return view('admin.edit_baidang', $data);
    }

    public function postEditBaiDang(Request $request, $id)
    {
        // $post = new Post;
        // $arr['post_name'] = $request->name;
        // $arr['post_slug'] = str::slug($request->name);
        // $arr['post_nguoidang'] = $request->poster;
        // $arr['post_mota'] = $request->description;

        // if($request->hasFile('image'))
        // {
        //     $img = $request->image->getClientOriginalName();
        //     $arr['post_image'] = $img;
        //     $request->image->storeAs('public/storage/post',$img);
        // }
        // $post::where('post_id', $id)->update($arr);
        // return redirect('admin/baidang');
        
        $request->validate([
            'name' => 'required', // Đảm bảo 'name' không trống
            // Có thể thêm các quy tắc kiểm tra khác cho các trường khác nếu cần
        ]);
    
        // Tìm bản ghi cần cập nhật
        $post = Post::find($id);
    
        if (!$post) {
            // Xử lý trường hợp không tìm thấy bản ghi với ID cung cấp
            // Bạn có thể trả về một phản hồi hoặc chuyển hướng tùy ý
        }
    
        // Cập nhật các trường của bản ghi
        $post->post_name = $request->name;
        $post->post_status = $request->status;
        $post->post_slug = Str::slug($request->name);
        $post->post_nguoidang = $request->poster;
        $post->post_mota = $request->description;
    
        if ($request->hasFile('image')) {
            $img = $request->image->getClientOriginalName();
            $post->post_image = $img;
            $request->image->storeAs('public/storage/post', $img);
        }
    
        // Lưu bản ghi đã cập nhật
        $post->save();
    
        return redirect('admin/baidang');
    }

    // Xóa bài
    public function getDeleteBaiDang($id)
    {
        Post::destroy($id);
        return back();
    }

    // Đếm số lượng bài đăng
    public function countPost()
    {
        $totalPosts = Post::count();
        return $totalPosts;
    }
}