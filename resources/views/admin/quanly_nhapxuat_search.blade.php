@extends('admin.master')
@section('title', 'Nhập - Xuất Kho')
@section('main')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div id="" class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH SẢN PHẨM</h6>
            <form id="signupForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="">
                <input type="text" name="total_product_quantities" id="total_product_quantities" placeholder="Số lượng muốn thêm" style="margin-right: 10px;">
                <input name="submit" type="submit" class="btn btn-primary" value="Thêm"></input>
                {{csrf_field()}}
            </form>
        </div>

        <div class="table-responsive" style="margin-bottom: 20px;">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">TỔNG SỐ LƯỢNG</th>
                        <th scope="col">TỔNG SẢN PHẨM TỒN</th>
                        <th scope="col">TỔNG SẢN PHẨM XUẤT</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="text-white">
                        <td>SL ban đầu + SL mới thêm</td>
                        <td>60</td>
                        <td>40</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div id="" class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;"></h6>
            <form class="d-none d-md-flex ms-4" action="{{asset('admin/nhap-xuat/search/')}}" role="search" method="get">
                <input class="form-control bg-dark border-0" name="result" type="text" placeholder="Tìm kiếm">
            </form>
        </div>

        <div class="table-responsive">
            @if(count($items) > 0)
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">TÊN SẢN PHẨM</th>
                        <th scope="col">MÀU</th>
                        <th scope="col">HÌNH ẢNH</th>
                        <th scope="col">GIÁ SẢN PHẨM</th>
                        <th scope="col">SỐ LƯỢNG</th>
                        <th scope="col">THAO TÁC</th>
                    </tr>
                </thead>
                @php
                $counter = 1;
                @endphp
                <tbody>
                    @foreach($items as $product)
                    <tr class="text-white">
                        <td>{{$counter}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->color_name}}</td>
                        <td>
                            <img height="100px" src="{{asset('storage/storage/avatar/'.$product->product_image)}}" alt="">
                        </td>
                        <td>{{number_format($product->product_price,0,',','.')}} VND</td>
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
                            <a class="btn btn-sm btn-primary" style="margin-bottom: 10px;" href="{{asset('admin/sanpham/edit/'.$product->product_id)}}">Edit</a>
                            <a class="btn btn-sm btn-primary" style="margin-bottom: 10px;" href="{{asset('admin/sanpham/delete/'.$product->product_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                    @php
                    $counter++;
                    @endphp
                    @endforeach
                </tbody>
                @else
                <p class="alert alert-danger">Không tìm thấy sản phẩm</p>
                @endif
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
        $(".navbar-nav .fa-cart-plus").parent().addClass("active");
    });
</script>
</body>

</html>
@stop