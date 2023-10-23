@extends('admin.master')
@section('title', 'Nhập - Xuất Kho')
@section('main')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        @include('errors.note')
        <div id="" class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH SẢN PHẨM NHẬP HÀNG</h6>
        </div>

        <div class="table-responsive" style="margin-bottom: 20px;">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">TỔNG SẢN PHẨM TỒN</th>
                        <th scope="col">TỔNG SẢN PHẨM XUẤT</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="text-white">
                        <td>{{$totalProductsKho}}</td>
                        <td>{{$totalMinusProductsKho}}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div id="" class="d-flex align-items-center justify-content-between mb-4">
            @if(empty($keyword))
            <p class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH SẢN PHẨM</p>
            @else
            <p class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">{{$keyword}}</p>
            @endif
            <form class="d-none d-md-flex ms-4" action="{{asset('admin/nhap-xuat/search/')}}" role="search" method="get">
                <input class="form-control bg-dark border-0" name="result" type="text" placeholder="Tìm kiếm theo tên">
            </form>
        </div>

        <div class="table-responsive">
            @if(count($items) > 0)
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col" style="display: none">ID SẢN PHẨM</th>
                        <th scope="col">TÊN SẢN PHẨM</th>
                        <th scope="col">HÌNH ẢNH</th>
                        <th scope="col">GIÁ SẢN PHẨM</th>
                        <th scope="col">SỐ LƯỢNG HIỆN CÓ</th>
                        <th scope="col">NHẬP THÊM</th>
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
                        <td style="display: none">
                            <input name="product_id" type="number" value="{{$product->product_id}}">
                        </td>
                        <td>{{$product->product_name}}</td>
                        <td>
                            <img height="100px" src="{{asset('storage/storage/avatar/'.$product->product_image)}}" alt="">
                        </td>
                        <td>{{number_format($product->product_price,0,',','.')}} VNĐ</td>
                        <td>
                            <!-- Số lượng sản phẩm: -->
                            @php
                            $productQuantity = DB::table('lv_product_quantities')
                            ->where('product_id', $product->product_id)
                            ->value('product_quantity');
                            @endphp
                            {{$productQuantity}}
                        </td>
                        <form action="" method="post">
                            <td style="width: 120px">
                                <!-- Lấy id của sản phẩm -->
                                <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                <!-- Lấy số lượng sản phẩm cần thêm -->
                                <input name="quantity" style="text-align: center;" class="form-control" type="number" value="0">
                            </td>
                            <td>
                                <input name="submit" type="submit" value="Lưu" class="btn btn-sm btn-primary" style="margin-bottom: 10px;"></input>
                                <a href="{{asset('user/cart/add/'.$product->product_id)}}" style="margin-bottom: 10px;" class="btn btn-sm btn-primary">THÊM</a>
                            </td>
                            {{csrf_field()}}
                        </form>
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