@extends('admin.master')
@section('title', 'Bài đăng')
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
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH BÀI ĐĂNG</h6>
            <a href="{{asset('admin/baidang/add')}}" class="btn btn-sm btn-primary">Thêm bài đăng</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">TÊN BÀI ĐĂNG</th>
                        <th scope="col">NGƯỜI ĐĂNG</th>
                        <th scope="col">NỘI DUNG</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">THỜI GIAN ĐĂNG</th>
                        <th scope="col">HIỂN THỊ</th>
                        <th scope="col">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listpost as $post)
                    <tr class="text-white">
                        <td>{{$post->post_id}}</td>
                        <td>{{$post->post_name}}</td>
                        <td>{{$post->post_nguoidang}}</td>
                        <td>{{$post->post_mota}}</td>
                        <td>
                            <img height="100px" src="{{asset('storage/storage/post/'.$post->post_image)}}" alt="">
                        </td>
                        <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <a href="#" class="toggle-action" data-brand="{{ $post->post_id }}">
                                <div class="toggle-switch {{ $post->post_status == 1 ? 'active' : '' }}">
                                    <input type="checkbox" id="status_{{ $post->post_id }}" name="status" value="{{ $post->post_status }}" @if($post->post_status == 1) checked @endif>
                                    <label for="status_{{ $post->post_id }}"></label>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{asset('admin/baidang/edit/'.$post->post_id)}}">Edit</a>
                            <a class="btn btn-sm btn-primary" href="{{asset('admin/baidang/delete/'.$post->post_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
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
        $(".navbar-nav .fa-bookmark").parent().addClass("active");
    });
</script>
</body>

</html>
@stop