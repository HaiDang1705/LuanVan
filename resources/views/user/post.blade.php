@extends('user.master')
@section('title', 'Tin tức')
@section('css', 'css/gioithieu.css')
@section('main')
<!-- Dòng 2 -->
<div class="row">
    <!-- Cột 1 -->
    <div class="col-md-9 slider-padding" style="margin-top: 20px;  padding: 0 100px;">
        <!-- Dòng 1 -->
        <div class="row">
            <a style="margin: 0 20px; color: rgba(0, 0, 0, 0.72); text-decoration: none;" class="a-hover" href="{{asset('user/index')}}">
                <h4 style="font-size: 16px;" class="row-margin">TRANG CHỦ</h4>
                <div style="width: 100%;" class="border-line"></div>
            </a>
            <h4 style="font-size: 16px;">></h4>
            <a style="margin: 0 20px; color: rgba(0, 0, 0, 0.72); text-decoration: none" class="a-hover" href="{{asset('user/news')}}">
                <h4 style="font-size: 16px;" class="row-margin">TIN TỨC</h4>
                <div style="width: 100%;" class="border-line"></div>
            </a>
            <h4 style="font-size: 16px;">></h4>
            <h4 style="margin-left: 20px; font-size: 16px;" class="row-margin h4-color">BÀI ĐĂNG</h4>
        </div>
        <!-- Dòng 2 -->
        <div class="row" style="margin-top: 20px;">
            <div class="col-12">
                <h2>{{$post->post_name}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h6>{{$post->post_nguoidang}} - {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</h6>
            </div>
        </div>
        <div style="width: 100%;" class="border-line"></div>
        <!-- Dòng 3 -->
        <div class="col-12">
            <!-- Image -->
            <div class="row" style="margin-bottom: 20px;margin-top: 10px;">
                <div class="col-1"></div>
                <div class="col-10">
                    <img src="{{asset('storage/storage/post/'.$post->post_image)}}" width="700" height="400" alt="">
                </div>
                <div class="col-1"></div>
            </div>
            <!-- Nội dung bài đăng -->
            <div class="row">
                <span>{{$post->post_mota}}</span>
            </div>
        </div>
    </div>
    <!-- Cột 2 -->
    <div class="col-md-3">
        <!-- Cột 2 dòng 1 -->
        <div class="row slider-padding">
            <div class="col-md-12">
                <h5>THẢO LUẬN NHIỀU</h5>
                <div class="border-line"></div>

                <span>Nghị Nguyễn trong <a class="a-post" href="#">Tai nghe Asus ROG Cetra True
                        Wireless</a></span>
                <div class="border-line-introducing"></div>
                <span>Như Hảo trong <a class="a-post" href="#">Tai nghe Airpod - Phiên bản 2022
                        (Trắng)</a></span>
                <div class="border-line-introducing"></div>
                <span>Phú Cường trong <a class="a-post" href="#">Điện thoại Iphone 14 256GB phiên bản LLA
                        2022</a></span>
                <div class="border-line-introducing"></div>
                <span>Đặng Lê Hoài Nam trong <a class="a-post" href="#">Laptop Gaming ASUS ROG Strix G15
                        G513QC-HN015T (R7 5800H | 8GB | 512GB | RTX 3050 4GB | 15.6 FHD 144Hz | Win
                        10)</a></span>
                <div class="margin-bottom"></div>
            </div>
        </div>

        <!-- Cột 2 dòng 2 -->
        <div class="row slider-padding">
            <div class="col-md-12">
                <h5>BÀI VIẾT MỚI</h5>
                <div class="border-line"></div>

                <a class="a-post" href="#">Mua PC ASUS ROG nhận ngay quà chất</a>
                <div class="border-line-introducing"></div>
                <a class="a-post" href="#">Đánh giá chuột công thái học: Logitech Lift Vertical có gì đáng mua
                    ?</a>
                <div class="border-line-introducing"></div>
                <a class="a-post" href="#">THAY ĐỔI DIỆN MẠO – ĐÓN CHÀO HÀNH TRÌNH MỚI</a>
                <div class="border-line-introducing"></div>
                <a class="a-post" href="#">Tặng tay cầm XBOX ONE khi mua màn hình gaming 21:9 Từ ASUS</a>
                <a class="a-post" href="#">HELLO SUMMER – SIÊU HOT CÙNG MÀN HÌNH QUANTUM DOT</a>
                <div class="margin-bottom"></div>
            </div>
        </div>
        <!-- Cột 2 dòng 3 -->
        <div class="row slider-padding">
            <div class="col-md-12">
                <h5>CHUYÊN MỤC</h5>
                <div class="border-line"></div>

                <span><a href="#" class="a-post">Khuyến mãi</a> (9)</span>
                <div class="border-line-introducing"></div>
                <span><a href="#" class="a-post">Thông tin</a> (1)</span>
                <div class="border-line-introducing"></div>
                <span><a href="#" class="a-post">Thông tin công nghệ</a> (1)</span>
                <div class="border-line-introducing"></div>
                <div class="margin-bottom"></div>
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
        $(".link .fa-newspaper").parent().addClass("color-text");
    });
</script>
</body>

</html>
@stop