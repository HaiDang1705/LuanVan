@extends('admin.master')
@section('title', 'Danh mục thương hiệu')
@section('main')
<style>
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .toggle-switch input[type="checkbox"] {
        display: none;
    }

    .toggle-switch label {
        position: absolute;
        top: 0;
        left: 0;
        width: 50px;
        height: 24px;
        background-color: #ccc;
        border-radius: 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .toggle-switch input[type="checkbox"]:checked+label {
        background-color: #4CAF50;
        /* Màu khi toggle bật (On) */
    }

    .toggle-switch label::before {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: white;
        top: 2px;
        left: 2px;
        transition: transform 0.3s ease;
    }

    .toggle-switch input[type="checkbox"]:checked+label::before {
        transform: translateX(26px);
        /* Di chuyển khi toggle bật (On) */
    }
</style>
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH NHÀ CUNG CẤP</h6>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <!-- <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header text-white">Danh mục sản phẩm</h1>
                            </div>
                        </div> -->

            <div class="row">
                <div class="col-xs-12 col-md-5 col-lg-5">
                    <div class="panel panel-primary">
                        <div style="margin-bottom: 20px;" class="panel-heading text-white">
                            Thêm nhà cung cấp
                        </div>
                        <div class="panel-body">
                            @include('errors.note')
                            <form method="post">
                                <!-- Nhập tên danh mục -->
                                <div class="form-group">
                                    <!-- <label style="margin-bottom: 10px;" class="text-white">Tên danh mục:</label> -->
                                    <input required style="background-color: white;" type="text" name="name" class="form-control" placeholder="Tên thương hiệu...">
                                </div>
                                <div class="form-group" style="margin-top: 10px;">
                                    <!-- <label style="margin-bottom: 10px;" class="text-white">Tên danh mục:</label> -->
                                    <input required style="background-color: white;" type="text" name="email" class="form-control" placeholder="Email nhà cung cấp...">
                                </div>
                                <div class="form-group" style="margin-top: 10px;">
                                    <!-- <label style="margin-bottom: 10px;" class="text-white">Tên danh mục:</label> -->
                                    <input required style="background-color: white;" type="text" name="phone" class="form-control" placeholder="Số điện thoại...">
                                </div>
                                <div class="form-group" style="margin-top: 10px;">
                                    <!-- <label style="margin-bottom: 10px;" class="text-white">Tên danh mục:</label> -->
                                    <input required style="background-color: white;" type="text" name="address" class="form-control" placeholder="Địa chỉ...">
                                </div>
                                <!-- Chọn hiển thị hoặc ẩn -->
                                <div class="form-group" style=" text-align: left !important; margin-top: 10px;">
                                    <select required name="status" id="">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                                <!-- Nút Thêm -->
                                <div class="form-group">
                                    <input style="margin-top: 20px;" type="submit" name="submit" class="btn btn-primary py-2 w-100 mb-4" value="THÊM MỚI"></input>
                                </div>
                                {{csrf_field()}}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 col-lg-7">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-white">Danh sách nhà cung cấp</div>
                        <div class="panel-body">
                            <div class="bootstrap-table">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-white">STT</th>
                                            <th class="text-white">Tên nhà cung cấp</th>
                                            <th class="text-white">Hiển thị</th>
                                            <th class="text-white">Ngày thêm</th>
                                            <th class="text-white" style="width:30%">Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($brandlist as $brand)
                                        <tr class="text-white" style="text-align: center;">
                                            <td>{{$brand->brand_id}}</td>
                                            <td>{{$brand->brand_name}}</td>
                                            <td>
                                                <!-- <a href="{{ asset('admin/thuonghieu/active-status-brand/'.$brand->brand_id)}}">
                                                    <div class="toggle-switch">
                                                        <input type="checkbox" id="status" name="status" value="1" @if($brand->brand_status == 1) checked @endif>
                                                        <label for="status"></label>
                                                    </div>
                                                </a> -->

                                                <!-- <a href="{{ asset('admin/thuonghieu/toggle-status-brand/' . $brand->brand_id) }}" class="toggle-action">
                                                    <div class="toggle-switch">
                                                        <input type="checkbox" id="status_{{ $brand->brand_id }}" name="status" value="1" @if($brand->brand_status == 1) checked @endif>
                                                        <label for="status_{{ $brand->brand_id }}"></label>
                                                    </div>
                                                </a> -->

                                                <a href="" class="toggle-action" data-brand="{{ $brand->brand_id }}">
                                                    <div class="toggle-switch {{ $brand->brand_status == 1 ? 'active' : '' }}">
                                                        <input type="checkbox" id="status_{{ $brand->brand_id }}" name="status" value="{{ $brand->brand_status }}" @if($brand->brand_status == 1) checked @endif>
                                                        <label for="status_{{ $brand->brand_id }}"></label>
                                                    </div>
                                                </a>

                                            </td>



                                            <td>{{ \Carbon\Carbon::parse($brand->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{asset('admin/thuonghieu/edit/'.$brand->brand_id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
                                                <a href="{{asset('admin/thuonghieu/delete/'.$brand->brand_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
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


        $('.toggle-action').on('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định (tải lại trang)
            var brandId = $(this).data('brand');
            var status = $('#status_' + brandId).val();

            // Gửi yêu cầu AJAX để cập nhật trạng thái
            $.ajax({
                url: '{{ url("admin/thuonghieu/toggle-status-brand") }}/' + brandId,
                type: 'POST',
                data: {
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Thay đổi trạng thái của nút toggle
                        $('#status_' + brandId).val(response.newStatus);
                        if (response.newStatus == 1) {
                            $('.toggle-switch[data-brand="' + brandId + '"]').addClass('active');
                        } else {
                            $('.toggle-switch[data-brand="' + brandId + '"]').removeClass('active');
                        }
                    } else {
                        // Xử lý lỗi hoặc thông báo khác tùy theo trường hợp
                        alert('Có lỗi xảy ra.');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra.');
                }
            });

        });
        // ------------------------------------------------------------
    });
</script>
</body>

</html>
@stop