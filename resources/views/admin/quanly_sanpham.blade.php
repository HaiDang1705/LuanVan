@extends('admin.master')
@section('title', 'Sản phẩm')
@section('main')
<style>
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .toggle-switch input[type="checkbox"] {
        display: none;
    }

    .toggle-switch label {
        position: absolute;
        top: 0;
        left: 0;
        width: 50px;
        height: 24px;
        background-color: #ccc;
        border-radius: 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .toggle-switch input[type="checkbox"]:checked+label {
        background-color: #4CAF50;
        /* Màu khi toggle bật (On) */
    }

    .toggle-switch label::before {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: white;
        top: 2px;
        left: 2px;
        transition: transform 0.3s ease;
    }

    .toggle-switch input[type="checkbox"]:checked+label::before {
        transform: translateX(26px);
        /* Di chuyển khi toggle bật (On) */
    }
</style>
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH SẢN PHẨM</h6>
            <a href="{{asset('admin/sanpham/add')}}" class="btn btn-sm btn-primary">Thêm Sản Phẩm</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">THƯƠNG HIỆU</th>
                        <th scope="col">TÊN DANH MỤC</th>
                        <th scope="col">LOẠI SẢN PHẨM</th>
                        <th scope="col">TÊN SẢN PHẨM</th>
                        <th scope="col">MÀU</th>
                        <th scope="col">HÌNH ẢNH</th>
                        <th scope="col">GIÁ BÁN</th>
                        <th scope="col">SỐ LƯỢNG</th>
                        <th scope="col">HIỂN THỊ</th>
                        <th scope="col">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listproduct as $product)
                    <tr class="text-white">
                        <td>{{$product->product_id}}</td>
                        <td>{{$product->brand_name}}</td>
                        <td>{{$product->cate_name}}</td>
                        <td>{{$product->type_name}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->color_name}}</td>
                        <td>
                            <img height="100px" src="{{asset('storage/storage/avatar/'.$product->product_image)}}" alt="">
                        </td>
                        <td>{{number_format($product->product_price,0,',',',')}}</td>
                        <td>
                            <!-- Số lượng sản phẩm: -->
                            @php
                            $productQuantity = DB::table('lv_product_quantities')
                            ->where('product_id', $product->product_id)
                            ->value('product_quantity');
                            @endphp
                            {{$productQuantity}}
                        </td>
                        <td>
                            <a href="#" class="toggle-action" data-brand="{{ $product->product_id }}">
                                <div class="toggle-switch {{ $product->product_status == 1 ? 'active' : '' }}">
                                    <input type="checkbox" id="status_{{ $product->product_id }}" name="status" value="{{ $product->product_status }}" @if($product->product_status == 1) checked @endif>
                                    <label for="status_{{ $product->product_id }}"></label>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" style="margin-bottom: 10px;" href="{{asset('admin/sanpham/edit/'.$product->product_id)}}">Edit</a>
                            <a class="btn btn-sm btn-primary" style="margin-bottom: 10px;" href="{{asset('admin/sanpham/delete/'.$product->product_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

@stop
@section('script')
<script>
    $(document).ready(function() {
        // Loại bỏ lớp active từ tất cả các liên kết trong phần tử có class "navbar-nav"
        $(".navbar-nav .nav-link").removeClass("active");

        // Thêm lớp active vào liên kết "Quản lý tài khoản"
        $(".navbar-nav .fa-laptop").parent().addClass("active");
    });
</script>
</body>

</html>
@stop