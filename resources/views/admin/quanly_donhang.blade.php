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
                        <th scope="col">THANH TOÁN</th>
                        <th scope="col">TÙY CHỌN</th>
                    </tr>
                </thead>
                @php
                $counter = 1;
                @endphp
                <tbody>
                    @foreach($orderlist as $order)
                    <tr class="text-white">
                        <td>{{$counter}}</td>
                        <td>
                            {{$order->created_at}}
                        </td>
                        <td>{{$order->shipping_total}} VNĐ</td>
                        <td>{{$order->shipping_name}}</td>
                        <!-- <td>0123456789</td>
                                    <td>Cần Thơ</td> -->
                        <td>
                            @if($order->shipping_states == 1)
                            <span style="padding: 10px 28px;background: red;border-radius: 12px;">Chưa xử lý</span>
                            @else
                            <span style="padding: 10px 28px;background: forestgreen;border-radius: 12px;">Đã xử lý</span>
                            @endif
                        </td>
                        <td>
                            {{$order->status_name}}
                        </td>
                        <td>
                            <a href="{{asset('admin/donhang/chitiet/'.$order->shipping_id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Chi tiết</a>
                            <a class="btn btn-sm btn-primary" href="{{asset('admin/donhang/delete/'.$order->shipping_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                    @php
                    $counter++;
                    @endphp
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
        $(".navbar-nav .fa-cart-plus").parent().addClass("active");
    });
</script>
</body>

</html>
@stop