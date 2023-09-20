<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Tinh;
use App\Http\Requests\AddTinhRequest;
use App\Http\Requests\EditTinhRequest;
use App\Models\Models\Xa;
use App\Http\Requests\AddXaRequest;
use App\Http\Requests\EditXaRequest;
use App\Models\Models\Huyen;
use App\Http\Requests\AddHuyenRequest;
use App\Http\Requests\EditHuyenRequest;
use Illuminate\Support\Facades\DB;


class AddressController extends Controller
{
    // ----------------------------------- TỈNH -------------------------------------------------------
    // Hiển thị tỉnh đăng
    public function getTinh()
    {
        $data['listtinh'] = Tinh::all();
        return view('admin.quanly_tinh',$data);
    }

    // Đăng tỉnh
    public function postTinh(AddTinhRequest $request)
    {
        $Tinh = new Tinh;
        $Tinh->Tinh_name = $request->name;
        $Tinh->save();
        return back();
    }
    // Sửa tỉnh
    public function getEditTinh($id)
    {
        $data['tinh'] = Tinh::find($id);
        return view('admin.edit_tinh', $data);
    }

    public function postEditTinh(EditTinhRequest $request, $id)
    {
        $Tinh = Tinh::find($id);
        $Tinh->Tinh_name = $request->name;

        $Tinh->save();
        return redirect()->intended('admin/tinh');
    }

    // Xóa tỉnh
    public function getDeleteTinh($id)
    {
        Tinh::destroy($id);
        return back();
    }
    // ----------------------------------------- XA -------------------------------------------------

    // Hiển thị tỉnh đăng
    public function getXa()
    {
        $data['listhuyen'] = Huyen::all();
        $data['listxa'] = DB::table('lv_xa')
        ->join('lv_huyen', 'lv_xa.xa_huyen', '=', 'lv_huyen.huyen_id')
        ->orderBy('lv_xa.xa_id', 'asc')
        ->get();
        return view('admin.quanly_xa',$data);
    }

    // Đăng tỉnh
    public function postXa(AddXaRequest $request)
    {
        $xa = new Xa;
        $xa->xa_name = $request->name;
        $xa->xa_huyen = $request->huyen;
        $xa->save();
        return back();
    }
    // Sửa tỉnh
    public function getEditXa($id)
    {
        $data['xa'] = Xa::find($id);
        $data['listhuyen'] = Huyen::all();
        return view('admin.edit_xa', $data);
    }

    public function postEditXa(EditXaRequest $request, $id)
    {
        $xa = Xa::find($id);
        $xa->xa_name = $request->name;
        $xa->xa_huyen = $request->huyen;
        $xa->save();
        return redirect()->intended('admin/xa');
    }

    // Xóa tỉnh
    public function getDeleteXa($id)
    {
        Xa::destroy($id);
        return back();
    }
    // -------------------------------------------- HUYỆN ----------------------------------------------
    // Hiển thị tỉnh đăng
    public function getHuyen()
    {
        $data['listtinh'] = Tinh::all();
        $data['listhuyen'] = DB::table('lv_huyen')
        ->join('lv_tinh', 'lv_huyen.huyen_tinh', '=', 'lv_tinh.tinh_id')
        ->orderBy('lv_huyen.huyen_id', 'asc')
        ->get();
        return view('admin.quanly_huyen',$data);
    }

    // Đăng tỉnh
    public function postHuyen(AddHuyenRequest $request)
    {
        $huyen = new Huyen;
        $huyen->huyen_name = $request->name;
        $huyen->huyen_tinh = $request->tinh;
        $huyen->save();
        return back();
    }
    // Sửa tỉnh
    public function getEditHuyen($id)
    {
        $data['huyen'] = Huyen::find($id);
        $data['listtinh'] = Tinh::all();
        return view('admin.edit_huyen', $data);
    }

    public function postEditHuyen(EditHuyenRequest $request, $id)
    {
        $huyen = Huyen::find($id);
        $huyen->huyen_name = $request->name;
        $huyen->huyen_tinh = $request->tinh;
        $huyen->save();
        return redirect()->intended('admin/huyen');
    }

    // Xóa tỉnh
    public function getDeleteHuyen($id)
    {
        Huyen::destroy($id);
        return back();
    }
}