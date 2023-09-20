@extends('user.master')
@section('title', 'Tin tức')
@section('css', 'css/gioithieu.css')
@section('main')
<!--------------------------------------------------------- Bắt đầu Thay ĐỔi ------------------------------------------------------------>
<!-- Dòng 2 -->
<div class="row">
    <!-- Cột 1 -->
    <div class="col-md-9 slider-padding">
        <!-- Cot 1 dong 1 -->
        @foreach($posts as $post)
        <div class="row">
            <div class="col-md-12">
                <span class="span-heading dropdown ">TIN TỨC CÔNG NGHỆ</span>
                <h3 class="dropdown h3-heading">{{$post->post_name}}</h3>
                <div class="border-line"></div>
                <span>POSTED ON <a class="a-post" href="#">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</a> BY <a class="a-post" href="#">{{$post->post_nguoidang}}</a></span>
                <div class="row">
                    <div class="col-md-6">
                        <img class="image" src="{{asset('storage/storage/post/'.$post->post_image)}}" width="500" height="300" alt="">
                    </div>
                    <div class="col-md-6">
                        <p class="p-content">{{$post->post_mota}}</p>
                        <br>
                        <a style="text-decoration: none;" href="{{asset('user/news/baidang/'.$post->post_id)}}" class="btnRead">
                            CONTINUE READING
                            <i class="fa fa-long-arrow-right icon-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="border-line-introducing"></div>
            </div>
        </div>
        @endforeach
        <!-- Thanh Điều Hướng -->
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-7">
                <nav aria-label="Page navigation example margin-left">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link page-color" href="#">1</a></li>
                        <li class="page-item"><a class="page-link  page-color-1" href="#">2</a></li>
                        <li class="page-item"><a class="page-link  page-color-1" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
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

<!--------------------------------------------------------- Kết Thúc Thay ĐỔi ------------------------------------------------------------>
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