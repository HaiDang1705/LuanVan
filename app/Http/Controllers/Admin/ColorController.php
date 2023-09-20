<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Database\Seeders\ColorProduct;
use App\Models\Models\Color;
use App\Http\Requests\AddColorRequest;
use App\Http\Requests\EditColorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ColorController extends Controller
{
    // Hiển thị màu đăng
    public function getColor()
    {
        $data['listcolor'] = Color::all();
        return view('admin.quanly_mauson',$data);
    }

    // Đăng màu
    public function postColor(AddColorRequest $request)
    {
        $color = new Color;
        $color->color_name = $request->name;
        $color->color_status = $request->status;
        $color->color_slug = str::slug($request->name);
        $color->save();
        return back();
    }
    // Sửa màu
    public function getEditColor($id)
    {
        $data['color'] = Color::find($id);
        return view('admin.edit_mauson', $data);
    }

    public function postEditColor(EditColorRequest $request, $id)
    {
        $color = Color::find($id);
        $color->color_name = $request->name;
        $color->color_status = $request->status;
        $color->color_slug = str::slug($request->name);
        $color->save();
        return redirect()->intended('admin/mauson');
    }

    // Xóa màu
    public function getDeleteColor($id)
    {
        Color::destroy($id);
        return back();
    }
}