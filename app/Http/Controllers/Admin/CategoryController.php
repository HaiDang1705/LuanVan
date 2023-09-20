<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// SU dung model Category
use App\Models\Models\Category;
use App\Http\Requests\AddCateRequest;
use App\Http\Requests\EditCateRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Hiển thị danh mục
    public function getCategory()
    {
        // lay tat ca du lieu trong Category
        $data['catelist'] = Category::all();
        return view('admin.quanly_danhmucsanpham', $data);
    }

    // Đăng danh mục
    public function postCategory(AddCateRequest $request)
    {
        $category = new Category;
        $category->cate_name = $request->name;
        $category->cate_status = $request->stacate_status;
        $category->cate_slug = str::slug($request->name);
        $category->save();
        return back();
    }
    // Hiển thị danh mục
    public function getEditCategory($id)
    {
        $data['cate'] = Category::find($id);
        return view('admin.edit_danhmucsanpham', $data);
    }

    // Sửa danh mục
    public function postEditCategory(EditCateRequest $request, $id)
    {
        $category = Category::find($id);
        $category->cate_name = $request->name;
        $category->cate_status = $request->status;
        $category->cate_slug = str::slug($request->name);
        $category->save();
        return redirect()->intended('admin/danhmucsanpham');
    }

    // Xóa danh mục
    public function getDeleteCategory($id)
    {
        Category::destroy($id);
        return back();
    }
}