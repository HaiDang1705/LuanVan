@extends('admin.master')
@section('title', 'Sửa bài đăng')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">CHỈNH SỬA BÀI ĐĂNG</h6>
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
                                <input name="name" value="{{$post->post_name}}" style=" text-align: left !important;" type="text" class="form-control" placeholder="Nhập tên bài đăng">
                            </div>
                        </div>
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Chọn người đăng<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <input name="poster" value="{{$post->post_nguoidang}}" style=" text-align: left !important;" type="text" class="form-control" placeholder="Nhập tên người đăng">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <select required name="status" id="">
                                    <option value="0" @if($post->post_status == 0) selected @endif>Ẩn</option>
                                    <option value="1" @if($post->post_status == 1) selected @endif>Hiển thị</option>
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
                                <textarea name="description" id="" cols="70" rows="10" placeholder="Nội dung bài đăng">{{$post->post_mota}}</textarea>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Ảnh sản phẩm<span style="color: red;">*</span></label>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Chọn ảnh mới<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <img height="100px" src="{{asset('storage/storage/post/'.$post->post_image)}}" alt="">
                            </div>
                            <div class="col-sm-6">
                                <input value="{{asset('storage/storage/post/'.$post->post_image)}}" type="file" name="image" id="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="">
                                <input name="submit" value="Cập nhật" type="submit" class="btn btn-primary"></input>
                                <a href="{{asset('admin/sanpham')}}" class="btn btn-primary">Hủy bỏ</a>
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