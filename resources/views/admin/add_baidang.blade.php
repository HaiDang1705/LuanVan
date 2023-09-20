@extends('admin.master')
@section('title', 'Bài đăng')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">THÊM BÀI ĐĂNG</h6>
        </div>
        <div class="">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    @include('errors.note')
                    <form id="signupForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="">
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Nhập tên bài đăng <span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input required name="name" style=" text-align: left !important;" type="text" class="form-control" placeholder="Nhập tên bài đăng">
                            </div>
                        </div>
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Chọn người đăng<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <input required name="poster" style=" text-align: left !important;" type="text" class="form-control" placeholder="Nhập tên người đăng">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <select required name="status" id="">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Nội dung bài đăng<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <textarea required name="description" id="" cols="70" rows="10" placeholder="Nội dung bài đăng"></textarea>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Chọn ảnh bài đăng<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input required type="file" name="image" id="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="">
                                <input name="submit" type="submit" class="btn btn-primary" value="Thêm"></input>
                                <a href="{{asset('admin/baidang')}}" class="btn btn-primary">Hủy bỏ</a>
                            </div>
                        </div>
                        {{csrf_field()}}
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
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
        $(".navbar-nav .fa-bookmark").parent().addClass("active");
    });
</script>
</body>

</html>
@stop