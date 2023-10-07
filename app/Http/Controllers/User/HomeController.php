<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// use ResponseHelper;

use App\Models\Models\Product;
use App\Models\Models\Category;
use App\Models\Models\Comment;
use App\Models\Models\Huyen;
use App\Models\Models\Tinh;
use App\Models\Models\Xa;
use App\Models\Models\CustomerInfor;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function getHome()
    {
        $data['listproducts'] = Product::orderBy('product_id', 'desc')->take(8)->get();
        $customer = Auth::guard('customer')->user();
        $data['customer'] = $customer;
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
        $customer = Auth::guard('customer')->user();
        $data['customer'] = $customer;
        $data['product'] = Product::find($id);
        $data['comments'] = Comment::where('bl_product_id', $id)->get();

        // Lượt xem
        $product = Product::find($id);
        $product->product_view += 1;
        $product->save();

        return view('user.product', $data);
    }

    public function getCategory($id)
    {
        $data['cateName'] = Category::find($id);
        $data['items'] = Product::where('product_cate', $id)->orderBy('product_id', 'desc')->paginate(8);
        return view('user.category', $data);
    }

    public function getLogout()
    {
        Auth::guard('customer')->logout();
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
        $result = str_replace(' ', '%', $result);
        $data['items'] = Product::where('product_name', 'like', '%' . $result . '%')->get();

        return view('user.search', $data);
    }

    public function getInfor($id)
    {
        $customer = Auth::guard('customer')->user();
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if ($customer) {
            $data['listtinh'] = Tinh::all();
            $data['listhuyen'] = Huyen::all();
            $data['listxa'] = Xa::all();
            // $data['customerinfo'] = CustomerInfor::find($id);
            // Thay thế CustomerInfor::find($id) bằng CustomerInfor::where('id_customer', $id)->first()
            $data['customerinfo'] = CustomerInfor::where('id_customer', $id)->first();
            // Sử dụng compact để truyền customer vào view
            return view('user.infor_user', compact('customer', 'data'));
        } else {
            // Người dùng chưa đăng nhập, bạn có thể chuyển hướng họ đến trang đăng nhập ở đây
            // return redirect()->route('user.login'); // Thay 'login' bằng tên route của trang đăng nhập của bạn
            return redirect('user/login');
        }
    }

    public function getHuyen(Request $request, $id)
    {
        $tinhId = $request->input('tinh_id');
        $huyenList = Huyen::where('huyen_tinh', $tinhId)->get();

        return response()->json($huyenList)
            ->header('Access-Control-Allow-Origin', '*');
    }

    public function getXa(Request $request, $id)
    {
        $huyenId = $request->input('huyen_id');
        $xaList = Xa::where('xa_huyen', $huyenId)->get();

        return response()->json($xaList);
    }

    public function postInfor(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            // Tìm thấy khách hàng với email tương ứng, cập nhật các trường khác
            $customer->name = $request->name;
            $customer->save();

            // Tìm thông tin cá nhân của khách hàng
            $customerInfor = CustomerInfor::where('id_customer', $customer->id)->first();

            if (!$customerInfor) {
                // Nếu không tìm thấy thông tin cá nhân, tạo mới
                $customerInfor = new CustomerInfor();
                $customerInfor->id_customer = $customer->id;
            }

            // Cập nhật trường địa chỉ
            $customerInfor->address = $request->address;
            $customerInfor->phone = $request->phone;

            // Xử lý tải lên ảnh và lưu tên file
            if ($request->hasFile('image')) {
                $filename = $request->image->getClientOriginalName();
                $request->image->storeAs('public/storage/avataruser', $filename);
                $customerInfor->image = $filename;
            }

            $customerInfor->save();

            // Lưu thông báo thành công vào Session
            Session::flash('success', 'Lưu thông tin thành công');
        } else {
            // Không tìm thấy khách hàng, xử lý tương ứng (ví dụ: thông báo lỗi)
            Session::flash('error', 'Không tìm thấy khách hàng với email này');
        }
        return back();
    }
}
