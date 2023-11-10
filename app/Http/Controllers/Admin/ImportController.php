<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Order;
use App\Models\Models\NhapKho;
use App\Models\Models\NhapKhoDetails;
use App\Models\Models\OrderCart;
use App\Models\Models\Brand;
use App\Models\Models\OrderDetail;
use App\Models\Models\ProductQuantity;
use App\Models\Models\Shipping_States;
use App\Models\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\App;

use function Symfony\Component\String\b;

class ImportController extends Controller
{
    // Hiển thị đơn hàng
    public function getImport()
    {
        // Tính tổng sản phẩm trong tồn trong kho
        $totalProductsKho = (new ProductController)->countProductKho();
        $data['totalProductsKho'] = $totalProductsKho;

        // Tính tổng sản phẩm trong tồn trong kho
        $totalMinusProductsKho = (new ProductController)->minusProductKho();
        $data['totalMinusProductsKho'] = $totalMinusProductsKho;

        $data['listproduct'] = DB::table('lv_product')->orderBy('lv_product.product_id', 'asc')->get();

        return view('admin.quanly_nhapxuat', $data);
    }

    public function postImport(Request $request)
    {
        $productId = $request->input('product_id');
        $quantityToAdd = $request->input('quantity'); // Số lượng nhập thêm

        // Lấy số lượng sản phẩm hiện có từ bảng 'lv_product_quantities'
        $productQuantity = DB::table('lv_product_quantities')
            ->where('product_id', $productId)
            ->value('product_quantity');

        // Cập nhật số lượng sản phẩm trong bảng 'lv_product_quantities'
        DB::table('lv_product_quantities')
            ->where('product_id', $productId)
            ->update(['product_quantity' => $productQuantity + $quantityToAdd]);

        Session::flash('success', "Thêm số lượng thành công");

        return back();
    }


    // Tìm kiếm sản phẩm theo tên
    public function getSearch(Request $request)
    {
        // Tính tổng sản phẩm trong tồn trong kho
        $totalProductsKho = (new ProductController)->countProductKho();
        $data['totalProductsKho'] = $totalProductsKho;

        // Tính tổng sản phẩm trong tồn trong kho
        $totalMinusProductsKho = (new ProductController)->minusProductKho();
        $data['totalMinusProductsKho'] = $totalMinusProductsKho;

        $result = $request->result;
        $data['keyword'] = $result;
        $result = str_replace(' ', '%', $result);
        $data['items'] = DB::table('lv_product')
            ->join('lv_colorproduct', 'lv_product.product_color', '=', 'lv_colorproduct.color_id')
            ->where('product_name', 'like', '%' . $result . '%')
            ->orderBy('lv_product.product_id', 'asc')
            ->get();
        return view('admin.quanly_nhapxuat_search', $data);
    }

    // Đếm số lượng đơn hàng
    public function countOrder()
    {
        $totalOrders = Order::count();
        return $totalOrders;
    }

    public function getProductsByQuantity($quantityFilter = null)
    {
        $query = DB::table('lv_product_quantities')
            ->join('lv_product', 'lv_product_quantities.product_id', '=', 'lv_product.product_id')
            ->select('lv_product.product_id', 'lv_product.product_name', 'lv_product.product_image', 'lv_product.product_price', 'lv_product_quantities.product_quantity');

        if ($quantityFilter !== null && $quantityFilter != 0) {
            if ($quantityFilter == 1) {
                // Lọc sản phẩm đã hết hàng
                $query->where('product_quantity', 0);
            } elseif ($quantityFilter == 2) {
                // Lọc sản phẩm dưới 10
                $query->where('product_quantity', '>', 0)->where('product_quantity', '<', 10);
            } elseif ($quantityFilter == 3) {
                // Lọc sản phẩm trên hoặc bằng 10
                $query->where('product_quantity', '>=', 10);
            }
        }

        $products = $query->get();
        $totalProductsKho = (new ProductController)->countProductKho();
        $totalMinusProductsKho = (new ProductController)->minusProductKho();

        return view('admin.quanly_nhapxuat', [
            'listproduct' => $products,
            'totalProductsKho' => $totalProductsKho,
            'totalMinusProductsKho' => $totalMinusProductsKho,
        ]);
    }

    // Hiển thị đơn hàng
    public function getNhapKho()
    {

        $data['listdonnhaps'] = NhapKho::all();

        return view('admin.quanly_nhapkho', $data);
    }

    // Chi tiet đơn hàng
    public function getChiTietNhapKho($id)
    {

        $data['donnhap'] = NhapKho::find($id);
        $data['donnhapdetails'] = NhapKhoDetails::where('nhapkho_id', $id)->get();
        // dd($data['donnhapdetails']);
        // $data['listproduct'] = Product::all();

        return view('admin.chitiet_nhapkho', $data);
    }

    // Hiển thị trang thêm đơn nhập hàng sản phẩm
    public function getAddDonNhapHang()
    {
        // $data['listproduct'] = Product::all();
        $data['listproduct'] = DB::table('lv_product')
            ->join('lv_category', 'lv_product.product_cate', '=', 'lv_category.cate_id')
            ->join('lv_brand', 'lv_product.product_brand', '=', 'lv_brand.brand_id')
            ->join('lv_typeproduct', 'lv_product.product_type', '=', 'lv_typeproduct.type_id')
            ->join('lv_colorproduct', 'lv_product.product_color', '=', 'lv_colorproduct.color_id')
            ->join('lv_product_quantities', 'lv_product.product_id', '=', 'lv_product_quantities.product_id')
            ->orderBy('lv_product.product_id', 'asc')
            ->get();
        $data['listbrand'] = Brand::all();
        return view('admin.add_donnhaphang', $data);
    }

    // Thêm đơn nhập hàng sản phẩm
    public function postAddDonNhapHang(Request $request)
    {
        // Lưu thông tin đơn nhập hàng => Mã đơn, người nhập đơn, nội dung đơn
        $donnhap = new NhapKho();
        $donnhap->nhapkho_ma = $request->madon;
        $donnhap->nhapkho_name = $request->name;
        $donnhap->nhapkho_total = $request->total;
        $donnhap->nhapkho_description = $request->description;
        $donnhap->save();

        $hasError = false; // Biến cờ để kiểm tra lỗi

        // Kiểm tra nếu danh sách sản phẩm tồn tại và là một mảng
        if ($request->has('product_name') && is_array($request->product_name)) {
            $listproduct = $request->product_name;
            $listbrand = $request->product_brand;
            $quantities = $request->quantity;
            $productPrices = $request->price_nhap;
            $images = $request->image; // Thêm trường hình ảnh

            foreach ($listproduct as $key => $productId) {
                $nhapkhoDetail = new NhapKhoDetails();
                $nhapkhoDetail->nhapkho_id = $donnhap->nhapkho_id;
                $nhapkhoDetail->product_id = $productId;
                $nhapkhoDetail->product_brand = $listbrand[$key]; // Sử dụng mảng nhà cung cấp
                $nhapkhoDetail->quantity = $quantities[$key];
                $nhapkhoDetail->price = $productPrices[$key];
                $nhapkhoDetail->image = $images[$key];
                $nhapkhoDetail->save();


                $newQuantity = $nhapkhoDetail->quantity;

                // Lấy số lượng sản phẩm hiện có từ bảng 'lv_product_quantities'
                $productQuantity = DB::table('lv_product_quantities')
                    ->where('product_id', $productId)
                    ->value('product_quantity');

                // Cập nhật số lượng sản phẩm trong bảng 'lv_product_quantities'
                DB::table('lv_product_quantities')
                    ->where('product_id', $productId)
                    ->update(['product_quantity' => $productQuantity + $newQuantity]);
            }
        }

        // if (!$hasError) {
        //     // Nếu không có lỗi, lưu đơn hàng
        //     Session::flash('success', "Thêm đơn nhập hàng thành công");
        //     $donnhap->save();
        // } else {
        //     Session::flash('error', "Thêm đơn nhập hàng thất bại");
        //     $donnhap->destroy($donnhap->nhapkho_id);
        // }

        // Session::flash('success', "Thêm đơn nhập hàng thành công");


        // $data['listproduct'] = Product::all();
        // return view('admin.add_donnhaphang', $data);
        return back()->with('success', "Thêm đơn nhập hàng thành công");
    }

    public function getDeleteProduct($id)
    {
        Product::destroy($id);
        Session::flash('success', 'Bạn đã xóa sản phẩm thành công');
        return back();
    }
}
