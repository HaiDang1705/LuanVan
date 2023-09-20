@extends('admin.master')
@section('title', 'Chi tiết đơn hàng')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">THÔNG TIN ĐƠN HÀNG</h6>
        </div>
        <!-- Thông tin chủ đơn hàng -->
        <div class="table-responsive" style="margin-bottom: 20px;">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">MÃ ĐƠN HÀNG</th>
                        <th scope="col">THỜI GIAN ĐẶT HÀNG</th>
                        <th scope="col">TÊN KHÁCH HÀNG</th>
                        <th scope="col">SỐ ĐIỆN THOẠI</th>
                        <th scope="col">ĐỊA CHỈ</th>
                        <!-- <th scope="col">TRẠNG THÁI ĐƠN HÀNG</th>
                                    <th scope="col">TRẠNG THÁI THANH TOÁN</th> -->
                        <!-- <th scope="col">TÙY CHỌN</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-white">
                        <td>1</td>
                        <td>
                            2023-08-23 16:30:00
                        </td>
                        <td>Nguyễn Văn A</td>
                        <td>0123456789</td>
                        <td>Cần Thơ</td>
                        <!-- <td>Đã xác nhận</td>
                                    <td>
                                        Chưa thanh toán
                                    </td> -->
                        <!-- <td>
                                        <a href="chitiet_donhang.html" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Chi tiết</a>
                                    </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Thông tin đơn hàng -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">CHI TIẾT ĐƠN HÀNG</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">HÌNH ẢNH</th>
                        <th scope="col">TÊN SẢN PHẨM</th>
                        <th scope="col">SỐ LƯỢNG</th>
                        <th scope="col">GIÁ TIỀN</th>
                        <th scope="col">TỔNG TIỀN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-white">
                        <td>1</td>
                        <td>
                            <!-- image -->
                        </td>
                        <td>
                            Sơn DIVA
                        </td>
                        <td>1</td>
                        <td>700.000 vnđ</td>
                        <td>700.000 vnđ</td>
                    </tr>
                    <tr class="text-white">
                        <td>2</td>
                        <td>
                            <!-- image -->
                        </td>
                        <td>
                            Sơn DIVA Cao cấp
                        </td>
                        <td>2</td>
                        <td>500.000 vnđ</td>
                        <td>1.000.000 vnđ</td>
                    </tr>
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
        $(".navbar-nav .fa-cart-plus").parent().addClass("active");
    });
</script>
</body>

</html>
@stop