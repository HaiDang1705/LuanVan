<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Su dung model Type de lay dl
use App\Models\Models\TypeProduct;
use App\Http\Requests\AddTypeProductRequest;
use App\Http\Requests\EditTypeRequest;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    // Hiển thị loại
    public function getType()
    {
        // lay tat ca du lieu trong Category
        $data['typelist'] = TypeProduct::all();
        return view('admin.quanly_loaisanpham', $data);
    }

    // Đăng loại
    public function postType(AddTypeProductRequest $request)
    {
        $type = new TypeProduct;
        $type->type_name = $request->name;
        $type->type_status = $request->status;
        $type->type_slug = str::slug($request->name);
        $type->save();
        return back();
    }

    // Sửa loại
    public function getEditType($id)
    {
        $data['type'] = TypeProduct::find($id);
        return view('admin.edit_loaisanpham', $data);
    }
    // Đăng loại
    public function postEditType(EditTypeRequest $request, $id)
    {
        $type = TypeProduct::find($id);
        $type->type_name = $request->name;
        $type->type_status = $request->status;
        $type->type_slug = str::slug($request->name);
        $type->save();
        return redirect()->intended('admin/loaisanpham');
    }

    // Xóa loại
    public function getDeleteType($id)
    {
        TypeProduct::destroy($id);
        return back();
    }
}