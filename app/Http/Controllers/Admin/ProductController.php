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
use App\Models\Models\ProductQuantity;
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
            // ->leftJoin('lv_product_quantities', 'lv_product.product_id', '=', 'lv_product_quantities.product_id')
            // ->select('lv_product.*', 'lv_product_quantities.product_quantity as product_quantity')
            ->orderBy('lv_product.product_id', 'asc')
            ->get();
        return view('admin.quanly_sanpham', $product);
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
        $product->product_view = 0;
        $product->save();

        // Lấy product_id sau khi đã lưu sản phẩm
        $product_id = $product->product_id;

        $productquantity = new ProductQuantity();
        $productquantity->product_id = $product_id;
        $productquantity->product_quantity = $request->quantity;
        $productquantity->save();

        $request->image->storeAs('public/storage/avatar', $filename);

        // Lưu thông báo thành công vào Session
        Session::flash('success', 'Thêm sản phẩm thành công');
        return back();
    }

    // Sửa sản phẩm
    public function getEditProduct($id)
    {
        $data['product'] = Product::find($id);
        // 
        // $data['productquantity'] = ProductQuantity::find($id);
        // Lấy thông tin số lượng sản phẩm từ bảng lv_product_quantities
        $data['productquantity'] = ProductQuantity::where('product_id', $id)->first();
        // 
        $data['listcate'] = Category::all();
        $data['listbrand'] = Brand::all();
        $data['listtype'] = TypeProduct::all();
        $data['listcolor'] = Color::all();
        return view('admin.edit_sanpham', $data);
    }

    public function postEditProduct(Request $request, $id)
    {
        // Lấy thông tin sản phẩm và số lượng sản phẩm
        $product = Product::find($id);
        $productQuantity = ProductQuantity::where('product_id', $id)->first();

        $product->product_name = $request->name;
        $product->product_slug = Str::slug($request->name);
        $product->product_price = $request->price;
        $product->product_mota = $request->description;
        $product->product_status = $request->status;
        $product->product_type = $request->type;
        $product->product_cate = $request->cate;
        $product->product_color = $request->color;
        $product->product_brand = $request->brand;

        if ($request->hasFile('image')) {
            $img = $request->image->getClientOriginalName();
            $product->product_image = $img;
            $request->image->storeAs('public/storage/avatar', $img);
        }

        $product->save();

        // Cập nhật số lượng sản phẩm trong bảng lv_product_quantities
        if ($productQuantity) {
            $productQuantity->product_quantity = $request->quantity;
            $productQuantity->save();
        } else {
            $newProductQuantity = new ProductQuantity();
            $newProductQuantity->product_id = $id;
            $newProductQuantity->product_quantity = $request->quantity;
            $newProductQuantity->save();
        }

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

    // Đếm số lượng sản phẩm tồn trong kho
    public function countProductKho()
    {
        $totalProductsKho = DB::table('lv_product_quantities')->sum('product_quantity');
        return $totalProductsKho;
    }

    // Đếm số lượng sản phẩm đã xuất trong kho
    public function minusProductKho()
    {
        $totalMinusProductsKho = DB::table('lv_shipping_details')->sum('quantity');
        return $totalMinusProductsKho;
    }

    // Hàm đếm số lượng lượt xem của sản phẩm
    public function countViewProductsAndPosts()
    {
        $totalView = DB::table('lv_product')
            ->select(DB::raw('SUM(product_view) as total_view'))
            ->unionAll(DB::table('lv_post')
                ->select(DB::raw('SUM(post_view) as total_view')))
            ->sum('total_view');

        return $totalView;
    }
}
