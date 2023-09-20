@extends('user.master')
@section('title', 'Liên hệ')
@section('css', 'css/gioithieu.css')
@section('main')

@stop
@section('script')
<script>
    $(document).ready(function() {
        // Loại bỏ lớp color-text từ tất cả các liên kết trong phần tử có class "navbar-nav"
        $(".link .link-a").removeClass("color-text");
        // Thêm lớp color-text vào liên kết "Quản lý tài khoản"
        $(".link .fa-phone").parent().addClass("color-text");
    });
</script>
</body>

</html>
@stop