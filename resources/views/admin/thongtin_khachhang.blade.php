@extends('admin.master')
@section('title', 'Thông tin khách hàng')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">THÔNG TIN KHÁCH HÀNG</h6>
            <!-- <button class="btn btn-sm btn-primary">Thêm Khách Hàng</button> -->
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">AVATAR</th>
                        <th scope="col">TÊN KHÁCH HÀNG</th>
                        <th scope="col">SỐ ĐIỆN THOẠI</th>
                        <th scope="col">ĐỊA CHỈ</th>
                        <th scope="col">THAO TÁC</th>
                        <!-- <th scope="col">THAO TÁC</th> -->
                    </tr>
                </thead>
                @php
                $counter = 1;
                @endphp
                <tbody>
                    @foreach($userlist as $account)
                    <tr class="text-white">
                        <td>{{$counter}}</td>
                        <td>
                            <!-- Image -->
                            <img src="{{asset('storage/storage/avataruser/'.$account->image)}}" height="100px" alt="">
                        </td>
                        <td>{{$account->name}}</td>
                        <td>{{$account->phone}}</td>
                        <td>{{$account->address}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="">Xóa</a>
                            <a class="btn btn-sm btn-primary" href="">Edit</a>
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
        $(".navbar-nav .fa-info-circle").parent().addClass("active");
    });
</script>

</body>

</html>
@stop