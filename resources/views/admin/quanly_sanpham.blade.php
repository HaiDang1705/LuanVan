@extends('admin.master')
@section('title', 'Sản phẩm')
@section('main')

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
                        <th scope="col">GIÁ SẢN PHẨM</th>
                        <th scope="col">SỐ LƯỢNG</th>
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
                        <td>{{number_format($product->product_price,0,',','.')}} VND</td>
                        <td></td>
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