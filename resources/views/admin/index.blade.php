@extends('admin.master')
@section('title', 'Trang chủ Admin')
@section('main')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng sản phẩm</p>
                    <h6 class="mb-0">{{ $totalProducts }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng bài đăng</p>
                    <h6 class="mb-0">{{ $totalPosts }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng doanh thu</p>
                    <h6 class="mb-0">{{$totalDoanhThu}}.000 VNĐ</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng đơn hàng</p>
                    <h6 class="mb-0">{{$totalOrders}}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-------------------------------------------- BẮT ĐẦU THAY ĐỔI NỘI DUNG ---------------------->
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;color: #EB1616;">KẾT QUẢ DOANH THU THEO NĂM</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">TÊN SẢN PHẨM</th>
                        <th scope="col">LOẠI SẢN PHẨM</th>
                        <th scope="col">SỐ LƯỢNG ĐƠN ĐẶT HÀNG</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-white">
                        <td>1</td>
                        <td>INV-0123</td>
                        <td>Iphone</td>
                        <td>300</td>
                    </tr>
                    <tr class="text-white">
                        <td>2</td>
                        <td>INV-0123</td>
                        <td>Iphone</td>
                        <td>300</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Lượt xem nhiều -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="">
            <div class="row">
                <div class="col-4">Tổng khách hàng: 10</div>
                <!-- Thống kê các bài viết nào được xem nhiều -->
                <div class="col-4">
                    <div class="align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #EB1616;">BÀI VIẾT XEM NHIỀU</h6>
                        <ol class="list_views">
                            @foreach($post_views as $post)
                            <li style="text-align: left;">
                                <a style="color: #ccc;margin-left: 10px;" href="{{asset('user/news/baidang/'.$post->post_id)}}">{{$post->post_name}} | <span style="color: yellow;">{{$post->post_view}}</span></a>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <!-- Thống kê các sản phẩm nào được xem nhiều -->
                <div class="col-4">
                    <div class="align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #EB1616;">SẢN PHẨM XEM NHIỀU</h6>
                        <ol class="list_views">
                            @foreach($product_views as $product)
                            <li style="text-align: left;">
                                <a style="color: #ccc;margin-left: 10px;" href="{{asset('user/detail/'.$product->product_id.'/'.$product->product_slug)}}">{{$product->product_name}} | <span style="color: yellow;">{{$product->product_view}}</span></a>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
<!-------------------------------------------- KẾT THÚC THAY ĐỔI NỘI DUNG ---------------------->

<!-- <script>
    $(document).ready(function() {
        $("#thongke a").click(function() {
            // Loại bỏ lớp active từ tất cả các liên kết trong phần tử có id "thongke"
            $("#thongke a").removeClass("active");
            // Thêm lớp active vào liên kết vừa được nhấp
            $(this).addClass("active");
        });
    });
</script> -->
@stop

@section('script')
<!-- <script>
    $(document).ready(function() {
        $("#thongke a").click(function() {
            // Loại bỏ lớp active từ tất cả các liên kết trong phần tử có id "thongke"
            $("#thongke a").removeClass("active");
            // Thêm lớp active vào liên kết vừa được nhấp
            $(this).addClass("active");
        });
    });
</script> -->
</body>

</html>
@stop