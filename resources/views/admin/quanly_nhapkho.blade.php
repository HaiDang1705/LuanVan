@extends('admin.master')
@section('title', 'Nhập Kho')
@section('main')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        @include('errors.note')
        <div id="" class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH ĐƠN NHẬP HÀNG</h6>
            <a href="{{asset('admin/nhap/add')}}" class="btn btn-sm btn-primary">Thêm đơn nhập hàng</a>
        </div>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">MÃ ĐƠN NHẬP</th>
                        <th scope="col">NGƯỜI NHẬP</th>
                        <th scope="col">NỘI DUNG</th>
                        <th scope="col">TỔNG TIỀN</th>
                        <th scope="col">NGÀY NHẬP</th>
                        <th scope="col">THAO TÁC</th>
                    </tr>
                </thead>
                @php
                $counter = 1;
                @endphp
                <tbody>
                    @foreach($listdonnhaps as $donnhap)
                    <tr class="text-white">
                        <td>{{$counter}}</td>
                        <td>{{$donnhap->nhapkho_ma}}</td>
                        <td>{{$donnhap->nhapkho_name}}</td>
                        <td>{{$donnhap->nhapkho_description}}</td>
                        <td>{{number_format($donnhap->nhapkho_total,0,',',',')}} VNĐ</td>
                        <td>{{$donnhap->created_at}}</td>
                        <td>
                            <a href="{{asset('admin/nhap/chitiet/'.$donnhap->nhapkho_id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Chi tiết</a>
                            <a class="btn btn-primary" href="" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
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