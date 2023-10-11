@extends('admin.master')
@section('title', 'Quản lý tài khoản khách hàng')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">QUẢN LÝ TÀI KHOẢN KHÁCH HÀNG</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">TÊN KHÁCH HÀNG</th>
                        <th scope="col">TÊN TÀI KHOẢN</th>
                        <th scope="col">DUYỆT</th>
                        <th scope="col">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userlist as $user)
                    
                    <tr class="text-white">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            Hiển thị / Ẩn
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{asset('admin/account_khachhang/delete/'.$user->user_id)}}">Xóa</a>
                            <!-- <a class="btn btn-sm btn-primary" href="">Edit</a> -->
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
        $(".navbar-nav .fa-user").parent().addClass("active");
    });
</script>

</body>

</html>
@stop