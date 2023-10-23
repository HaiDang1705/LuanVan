@extends('admin.master')
@section('title', 'Sửa sản phẩm')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">SỬA SẢN PHẨM</h6>
        </div>
        <div class="">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    @include('errors.note')
                    <form id="signupForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="">
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input required name="name" value="{{$product->product_name}}" style=" text-align: left !important;" type="text" class="form-control" placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Chọn thương hiệu<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <select required name="brand" id="">
                                    @foreach($listbrand as $brand)
                                    <option value="{{$brand->brand_id}}" @if($product->
                                        product_brand == $brand->brand_id) selected @endif>
                                        {{$brand->brand_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Chọn danh mục<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <select required name="cate" id="">
                                    @foreach($listcate as $cate)
                                    <option value="{{$cate->cate_id}}" @if($product->
                                        product_cate == $cate->cate_id) selected @endif>
                                        {{$cate->cate_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Chọn loại sản phẩm<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <select required name="type" id="">
                                    @foreach($listtype as $type)
                                    <option value="{{$type->type_id}}" @if($product->
                                        product_type == $type->type_id) selected @endif>
                                        {{$type->type_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Màu<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <select required name="color" id="">
                                    @foreach($listcolor as $color)
                                    <option value="{{$color->color_id}}" @if($product->
                                        product_color == $color->color_id) selected @endif>
                                        {{$color->color_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Trạng thái:<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" style=" text-align: left !important;">
                                <select required name="status" id="">
                                    <option value="0" @if($product->product_status == 0) selected @endif>Ẩn</option>
                                    <option value="1" @if($product->product_status == 1) selected @endif>Hiển thị</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Chọn giá sản phẩm<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input required name="price" value="{{$product->product_price}}" type="price" class="form-control" placeholder="Giá sản phẩm">
                            </div>
                        </div>
                        <!--  -->
                        <!--  -->
                        <!--  -->
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <textarea required name="description" id="" cols="70" rows="10" placeholder="">{{$product->product_mota}}</textarea>
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
                                <img height="100px" src="{{asset('storage/storage/avatar/'.$product->product_image)}}" alt="">
                            </div>
                            <div class="col-sm-6">
                                <input value="{{asset('storage/storage/avatar/'.$product->product_image)}}" type="file" name="image" id="">
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
        $(".navbar-nav .fa-laptop").parent().addClass("active");
    });
</script>
</body>

</html>
@stop