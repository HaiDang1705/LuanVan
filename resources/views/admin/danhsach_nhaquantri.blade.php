@extends('admin.master')
@section('title', 'Danh sách nhà quản trị')
@section('main')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH NHÀ QUẢN TRỊ
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">TÊN NGƯỜI QUẢN TRỊ</th>
                        <th scope="col">TÊN TÀI KHOẢN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userlist as $user)
                    
                    <tr class="text-white">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <!-- <td>
                            <a class="btn btn-sm btn-primary" href="">Xóa</a>
                            <a class="btn btn-sm btn-primary" href="{{asset('admin/listadmin/edit')}}">Edit</a>
                        </td> -->
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