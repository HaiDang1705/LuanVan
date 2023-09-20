@extends('admin.master')
@section('title', 'Xã')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH Xã</h6>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-lg-5">
                    <div class="panel panel-primary">
                        <div style="margin-bottom: 20px;" class="panel-heading text-white">
                            Thêm Xã
                        </div>
                        <div class="panel-body">
                            @include('errors.note')
                            <form method="post">
                                <!-- Nhập tên tỉnh -->
                                <div class="form-group">
                                    <!-- <label style="margin-bottom: 10px;" class="text-white">Tên tỉnh:</label> -->
                                    <input required style="background-color: white;" type="text" name="name" class="form-control" placeholder="Tên xã...">
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
                        <div class="panel-heading text-white">Danh sách xã</div>
                        <div class="panel-body">
                            <div class="bootstrap-table">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-white">STT</th>
                                            <th class="text-white">Tên xã</th>
                                            <th class="text-white">Ngày thêm</th>
                                            <th class="text-white" style="width:30%">Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listxa as $xa)
                                        <tr class="text-white" style="text-align: center;">
                                            <td>{{$xa->xa_id}}</td>
                                            <td>{{$xa->xa_name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($xa->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{asset('admin/xa/edit/'.$xa->xa_id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
                                                <a href="{{asset('admin/xa/delete/'.$xa->xa_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
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
        $(".navbar-nav .fa-map-market").parent().addClass("active");
    });
</script>
</body>

</html>
@stop