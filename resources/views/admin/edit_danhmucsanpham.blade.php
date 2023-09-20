@extends('admin.master')
@section('title', 'Sửa danh mục sản phẩm')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-5">
            <div class="bg-secondary text-center rounded p-4">
                <div class="align-items-center justify-content-between mb-4">
                    <h6 class="mb-0" style="font-size: 24px;color: #EB1616;">DANH MỤC SẢN PHẨM</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-hover mb-0">
                        <thead>
                            <tr class="text-white" style="text-align: left;">
                                <th scope="col">SỬA DANH MỤC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('errors.note')
                            <form action="" method="post">
                                <tr class="text-white" style="text-align: left;">
                                    <td>Tên danh mục:</td>
                                </tr>
                                <tr class="text-white">
                                    <td><input style="background-color: white;" type="text" name="name" class="form-control" placeholder="Tên danh mục..." value="{{$cate->cate_name}}"></td>
                                </tr>
                                <tr class="text-white" style="text-align: left;">
                                    <td>Hiển thị:</td>
                                </tr>
                                <tr class="text-white">
                                    <td style=" text-align: left !important;">
                                        <select required name="status" id="">
                                        <option value="0" @if($cate->cate_status == 0) selected @endif>Ẩn</option>
                                            <option value="1" @if($cate->cate_status == 1) selected @endif>Hiển thị</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="text-white">
                                    <td><button type="submit" name="submit" class="btn btn-primary py-2 w-100 mb-4">SỬA</button></td>
                                </tr>
                                <tr class="text-white">
                                    <td><a href="{{asset('admin/danhmucsanpham')}}" class="btn btn-primary py-2 w-100 mb-4">HỦY BỎ</a></td>
                                </tr>
                                {{csrf_field()}}
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5"></div>
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
        $(".navbar-nav .fa-laptop").parent().addClass("active");
    });
</script>
</body>

</html>
@stop