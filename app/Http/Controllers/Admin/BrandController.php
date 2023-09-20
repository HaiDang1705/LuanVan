<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// SU dung model Brand
use App\Models\Models\Brand;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\EditBrandRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    // Hiển thị danh mục
    public function getBrand()
    {
        // lay tat ca du lieu trong Brand
        $data['brandlist'] = Brand::all();
        return view('admin.quanly_thuonghieusanpham', $data);
        // return view('admin.quanly_thuonghieusanpham');
    }

    // Đăng danh mục
    public function postBrand(AddBrandRequest $request)
    {
        $brand = new Brand;
        $brand->brand_name = $request->name;
        $brand->brand_status = $request->status;
        $brand->save();
        return back();
    }
    // Hiển thị danh mục
    public function getEditBrand($id)
    {
        $data['brand'] = Brand::find($id);
        return view('admin.edit_thuonghieu', $data);
    }

    // Sửa danh mục
    public function postEditBrand(EditBrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        $brand->brand_name = $request->name;
        $brand->brand_status = $request->status;
        $brand->save();
        return redirect()->intended('admin/thuonghieu');
    }

    // Xóa danh mục
    public function getDeleteBrand($id)
    {
        Brand::destroy($id);
        return back();
    }

    public function activeStatusBrand($id)
    {
        DB::table('lv_brand')->where('brand_id', $id)->update(['brand_status' => 1]);
        Session::flash('success', 'Kích hoạt trạng thái hiển thị');
        return redirect()->intended('admin/thuonghieu');
    }

    public function unactiveStatusBrand($id)
    {
        DB::table('lv_brand')->where('brand_id', $id)->update(['brand_status' => 0]);
        Session::flash('error', 'Không kích hoạt trạng thái hiển thị');
        return redirect()->intended('admin/thuonghieu');
    }

    public function toggleStatusBrand(Request $request, $id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            // Đảm bảo trạng thái hiện tại là 0 hoặc 1
            $currentStatus = $brand->brand_status;
            $newStatus = $currentStatus == 1 ? 0 : 1;

            // Cập nhật trạng thái mới vào cơ sở dữ liệu
            $brand->brand_status = $newStatus;
            $brand->save();

            // Trả về kết quả cho phía client
            return response()->json(['status' => 'success', 'newStatus' => $newStatus]);
        }

        return response()->json(['status' => 'error']);
    }
}
