@extends('admin.master')
@section('title', 'Đơn hàng')
@section('main')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH ĐƠN HÀNG</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">THỜI GIAN ĐẶT HÀNG</th>
                        <th scope="col">TỔNG TIỀN</th>
                        <th scope="col">TÊN KHÁCH HÀNG</th>
                        <!-- <th scope="col">SỐ ĐIỆN THOẠI</th>
                                    <th scope="col">ĐỊA CHỈ</th> -->
                        <th scope="col">TRẠNG THÁI ĐƠN HÀNG</th>
                        <th scope="col">TRẠNG THÁI THANH TOÁN</th>
                        <th scope="col">TÙY CHỌN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-white">
                        <td>1</td>
                        <td>
                            2023-08-23 16:30:00
                        </td>
                        <td>700.000 vnđ</td>
                        <td>Nguyễn Văn A</td>
                        <!-- <td>0123456789</td>
                                    <td>Cần Thơ</td> -->
                        <td>Đã xác nhận</td>
                        <td>
                            Chưa thanh toán
                            <!-- <a class="btn btn-sm btn-primary" href="">Xóa</a>
                                        <a class="btn btn-sm btn-primary" href="">Edit</a> -->
                        </td>
                        <td>
                            <a href="{{asset('admin/donhang/chitiet')}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Chi tiết</a>
                            <a class="btn btn-sm btn-primary" href="{{asset('admin/donhang/delete/')}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                    <tr class="text-white">
                        <td>2</td>
                        <td>
                            <!-- Image -->
                            2023-08-23 16:30:00
                        </td>
                        <td>700.000 vnđ</td>
                        <td>Nguyễn Văn B</td>
                        <!-- <td>0123456789</td>
                                    <td>Cần Thơ</td> -->
                        <td>Đang xác nhận</td>
                        <td>
                            Chưa thanh toán
                            <!-- <a class="btn btn-sm btn-primary" href="">Xóa</a>
                                        <a class="btn btn-sm btn-primary" href="">Edit</a> -->
                        </td>
                        <td>
                            <a href="{{asset('admin/donhang/chitiet')}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Chi tiết</a>
                            <a class="btn btn-sm btn-primary" href="{{asset('admin/donhang/delete/')}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
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