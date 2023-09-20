@extends('admin.master')
@section('title', 'Bình luận')
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
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">DANH SÁCH BÌNH LUẬN</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">TÊN</th>
                        <th scope="col">ẢNH</th>
                        <th scope="col">SẢN PHẨM</th>
                        <th scope="col">NỘI DUNG</th>
                        <th scope="col">THỜI GIAN BÌNH LUẬN</th>
                        <th scope="col">HIỂN THỊ</th>
                        <th scope="col">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commentlist as $comment)
                    <tr class="text-white">
                        <td>{{$comment->bl_id}}</td>
                        <td>{{$comment->bl_name}}</td>
                        <td>
                            <img height="100px" src="{{asset('storage/storage/avatar/'.$comment->product_image)}}" alt="">
                        </td>
                        <td>
                            {{$comment->product_name}}
                        </td>
                        <td>{{$comment->bl_content}}</td>
                        <td>{{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <a href="#" class="toggle-action" data-brand="{{ $comment->bl_id }}">
                                <div class="toggle-switch {{ $comment->bl_status == 1 ? 'active' : '' }}">
                                    <input type="checkbox" id="status_{{ $comment->bl_id }}" name="status" value="{{ $comment->bl_status }}" @if($comment->bl_status == 1) checked @endif>
                                    <label for="status_{{ $comment->bl_id }}"></label>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
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