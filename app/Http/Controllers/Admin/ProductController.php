<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
//MODELS
use App\Models\Models\Product;
use App\Models\Models\Category;
use App\Models\Models\TypeProduct;
use App\Models\Models\Brand;
use App\Models\Models\Color;
//
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    // Hiển thị sản phẩm
    public function getProduct()
    {
        $product['listproduct'] = DB::table('lv_product')
            ->join('lv_category', 'lv_product.product_cate', '=', 'lv_category.cate_id')
            ->join('lv_brand', 'lv_product.product_brand', '=', 'lv_brand.brand_id')
            ->join('lv_typeproduct', 'lv_product.product_type', '=', 'lv_typeproduct.type_id')
            ->join('lv_colorproduct', 'lv_product.product_color', '=', 'lv_colorproduct.color_id')
            ->orderBy('lv_product.product_id', 'asc')
            ->get();
        // Lấy tổng số sản phẩm
        // $totalProducts = $this->countProduct();
        return view('admin.quanly_sanpham', $product);
        // return view('admin.quanly_sanpham', compact('product', 'totalProducts'));
    }

    // Thêm sản phẩm
    public function getAddProduct()
    {
        $data['listbrand'] = Brand::all();
        $data['listcate'] = Category::all();
        $data['listtype'] = TypeProduct::all();
        $data['listcolor'] = Color::all();
        return view('admin.add_sanpham', $data);
    }
    public function postAddProduct(AddProductRequest $request)
    {
        $filename = $request->image->getClientOriginalName();
        $product = new Product();
        $product->product_name = $request->name;
        $product->product_slug = str::slug($request->name);
        $product->product_image = $filename;
        $product->product_price = $request->price;
        $product->product_mota = $request->description;
        $product->product_status = $request->status;
        $product->product_type = $request->type;
        $product->product_cate = $request->cate;
        $product->product_color = $request->color;
        $product->product_brand = $request->brand;

        $product->save();
        $request->image->storeAs('public/storage/avatar', $filename);

        // Lưu thông báo thành công vào Session
        Session::flash('success', 'Thêm sản phẩm thành công');
        return back();
    }

    // Sửa sản phẩm
    public function getEditProduct($id)
    {
        $data['product'] = Product::find($id);
        $data['listcate'] = Category::all();
        $data['listbrand'] = Brand::all();
        $data['listtype'] = TypeProduct::all();
        $data['listcolor'] = Color::all();
        return view('admin.edit_sanpham', $data);
    }

    public function postEditProduct(Request $request, $id)
    {
        $product = new Product;
        $arr['product_name'] = $request->name;
        $arr['product_slug'] = str::slug($request->name);
        $arr['product_price'] = $request->price;
        $arr['product_mota'] = $request->description;
        $arr['product_status'] = $request->status;
        $arr['product_type'] = $request->type;
        $arr['product_cate'] = $request->cate;
        $arr['product_color'] = $request->color;
        $arr['product_brand'] = $request->brand;

        if ($request->hasFile('image')) {
            $img = $request->image->getClientOriginalName();
            $arr['product_image'] = $img;
            $request->image->storeAs('public/storage/avatar', $img);
        }
        $product::where('product_id', $id)->update($arr);
        // Lưu thông báo thành công vào Session
        Session::flash('success', 'Cập nhật sản phẩm thành công');
        return back();
    }

    // Xóa sản phẩm
    public function getDeleteProduct($id)
    {
        Product::destroy($id);
        return back();
    }

    // Đếm số lượng sản phẩm
    public function countProduct()
    {
        $totalProducts = Product::count();
        return $totalProducts;
    }
}
