@extends('user.master')
@section('title', 'Tin tức')
@section('css', 'css/gioithieu.css')
@section('main')
<!-- Dòng 2 -->
<div class="row">
    <!-- Cột 1 -->
    <div class="col-md-12 slider-padding" style="margin-top: 20px;  padding: 0 100px;">
        <!-- Dòng 1 -->
        <div class="row">
            <a style="margin: 0 20px; color: rgba(0, 0, 0, 0.72); text-decoration: none;" class="a-hover" href="index.html">
                <h4 style="font-size: 16px;" class="row-margin">TRANG CHỦ</h4>
                <div style="width: 100%;" class="border-line"></div>
            </a>
            <h4 style="font-size: 16px;">></h4>
            <a style="margin: 0 20px; color: rgba(0, 0, 0, 0.72); text-decoration: none" class="a-hover" href="gioithieu.html">
                <h4 style="font-size: 16px;" class="row-margin">MẪU NHÀ ĐẸP</h4>
                <div style="width: 100%;" class="border-line"></div>
            </a>
            <h4 style="font-size: 16px;">></h4>
            <h4 style="margin-left: 20px; font-size: 16px;" class="row-margin h4-color">MẪU</h4>
        </div>
        <!-- Dòng 2 -->
        <div class="row" style="margin-top: 20px;">
            <div class="col-12" style="margin-bottom: 20px;">
                <!-- 1 dòng 3 cột -->
                <div class="row">
                    <!-- cột 1 -->
                    <div class="col-4">
                        <div style="border: 4px solid gray; padding: 20px;border-radius: 16px; text-align: center;">
                            <img src="image/maunhapho.jpg" width="300" height="300" alt="" style="margin: 0 45px; border-radius: 10px;">
                            <a class="color-text" href="maunhapho.html" style="text-align: center; margin-top: 10px; text-decoration: none; font-size: 20px; font-weight: 500;">MẪU
                                NHÀ PHỐ</a>
                        </div>
                    </div>
                    <!-- cột 2 -->
                    <div class="col-4">
                        <div style="border: 4px solid gray; padding: 20px;border-radius: 16px; text-align: center;">
                            <img src="image/maunhapho_1.jpg" width="300" height="300" alt="" style="margin: 0 45px; border-radius: 10px;">
                            <a class="color-text" href="maunhapho.html" style="text-align: center; margin-top: 10px; text-decoration: none; font-size: 20px; font-weight: 500;">BIỆT
                                THỰ HIỆN ĐẠI</a>
                        </div>
                    </div>
                    <!-- cột 3 -->
                    <div class="col-4">
                        <div style="border: 4px solid gray; padding: 20px;border-radius: 16px; text-align: center;">
                            <img src="image/maunhapho.jpg" width="300" height="300" alt="" style="margin: 0 45px;border-radius: 10px;">
                            <a class="color-text" href="maunhapho.html" style="text-align: center; margin-top: 10px; text-decoration: none; font-size: 20px; font-weight: 500;">BIỆT
                                THỰ TÂN CỔ ĐIỂN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    $(document).ready(function() {
        // Loại bỏ lớp color-text từ tất cả các liên kết trong phần tử có class "navbar-nav"
        $(".link .link-a").removeClass("color-text");
        // Thêm lớp color-text vào liên kết "Quản lý tài khoản"
        $(".link .fa-home").parent().addClass("color-text");
    });
</script>
</body>

</html>
@stop