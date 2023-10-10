<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/luanvan/lib/public/user/layout/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Liên kết Bootstrap CSS -->
    <link rel="stylesheet" href="plugin/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <!-- Liên kết Fontawsome -->
    <!-- <link rel="stylesheet" href="plugin/font-awesome-4.7.0/css/font-awesome.min.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Liên kết Jquey UI -->
    <link rel="stylesheet" href="plugin/jquery-ui-1.13.1.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="plugin/jquery-ui-1.13.1.custom/jquery-ui.theme.css">
    <!--  -->
    <link rel="stylesheet" href="@yield('css')">
    <title>@yield('title')</title>

</head>

<body>
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Just an image -->
        <a class="navbar-brand" href="#">
            <img src="image/Phone.svg" width="50" height="50" alt="">
            <a class="navbar-brand navbar-color" href="index.html">TRUCTIEN.STORE</a>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- SEARCH START -->
            <form action="{{asset('user/search/')}}" role="search" method="get">
                <div class="form">
                    <i class="fa fa-search"></i>
                    <input name="result" type="text" class="form-control form-input" placeholder="Nhập tên sản phẩm cần tìm...">
                    <span class="left-pan"><i class="fa fa-microphone"></i></span>
                </div>
            </form>
            <!-- SEARCH END -->

            <ul class="navbar-nav ml-auto">
                <!-- Đoạn code đầu tiên khi chưa login -->
                <!-- <li class="nav-item">
                    <a class="nav-link navbar-color" href="{{asset('user/cart')}}">
                        GIỎ HÀNG
                        <i class="fa fa-shopping-cart icon-color" aria-hidden="true"></i>
                    </a>
                </li> -->

                <!-- -------------------------------------------------------- -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{asset('user/login')}}">ĐĂNG NHẬP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('user/register')}}"> ĐĂNG KÝ</a>
                </li> -->
                <!-- -------------------------------------------------------- -->

                <!-- Thay thế đoạn code đăng nhập và đăng ký -->
                @if (Auth::guard('customer')->check())
                <li class="nav-item">
                    <div class="nav-item dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            {{ Auth::guard('customer')->user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{asset('user/infor/'.$customer->id)}}" class="dropdown-item">Thông tin của tôi</a>
                            <a href="{{asset('user/cart-history/'.$customer->id)}}" class="dropdown-item">Lịch sử mua hàng</a>
                            <a href="{{asset('user/logout')}}" class="dropdown-item">Đăng xuất</a>
                        </div>
                    </div>
                </li>
                
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('user/login')}}">ĐĂNG NHẬP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('user/register')}}"> ĐĂNG KÝ</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link navbar-color" href="{{ Auth::guard('customer')->check() ? route('cart.show', $customer->id) : route('cart.show') }}">
                        GIỎ HÀNG
                        <!-- Khi khách hàng đã đăng nhập -->
                        @if(Auth::guard('customer')->check())
                        <i class="fa fa-shopping-cart icon-color" aria-hidden="true"> ({{$count}})</i>
                        <!-- Khi khách hàng chưa đăng nhập -->
                        @else
                        <i class="fa fa-shopping-cart icon-color" aria-hidden="true"> ({{Cart::count()}})</i>
                        @endif
                    </a>
                </li>
                
                <!--  -->
            </ul>
        </div>
    </nav>
    <!-- Navbar finish -->

    <div class="container-fluid">
        <!-- Slider Start -->
        <div id="thongke" class="row slider-padding link">
            <div class="col-md-2 slider-padding-hover link-a">
                <a class="dropdown dropdown-font color-text link-a" href="{{asset('user/index')}}">
                    SẢN PHẨM <i class="fa fa-th" style="font-size: 20px;" aria-hidden="true"></i>
                    <i class="fa fa-angle-down icon-color" aria-hidden="true"></i>
                </a>
                <div class="border-line-footer"></div>
            </div>
            <div class="col-md-2 slider-padding-hover link-a">
                <a class="dropdown dropdown-font" href="{{asset('user/news')}}">TIN TỨC <i class="fa fa-newspaper" style="font-size: 20px;" aria-hidden="true"></i></a>
                <div class="border-line-footer"></div>
            </div>
            <div class="col-md-2 slider-padding-hover link-a">
                <a class="dropdown dropdown-font" href="{{asset('user/home')}}">MẪU NHÀ ĐẸP <i class="fa fa-home" style="font-size: 20px;" aria-hidden="true"></i></a>
                <div class="border-line-footer"></div>
            </div>
            <div class="col-md-2 slider-padding-hover link-a">
                <a class="dropdown dropdown-font" href="{{asset('user/contact')}}">LIÊN HỆ <i class="fa fa-phone" style="font-size: 20px;" aria-hidden="true"></i></a>
                <div class="border-line-footer"></div>
            </div>
            <div class="col-md-2 slider-padding-hover"></div>
        </div>
        <!-- Slider End -->

        @yield('main')

        <!-- Footer Start -->
        <footer class="text-center text-lg-start bg-footer text-muted">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span>Kết nối với chúng tôi qua các mạng xã hội: </span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fa fa-google" aria-hidden="true"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fa fa-github" aria-hidden="true"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4 text-size-footer">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="navbar-brand navbar-color" href="#">TRUCTIEN.STORE</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="image/Phone.svg" width="220" height="250" alt="#">
                                        </div>
                                    </div>
                                </div>
                            </h6>
                            <!-- <p>
                  Here you can use rows and columns to organize your footer content. Lorem ipsum
                  dolor sit amet, consectetur adipisicing elit.
                </p> -->
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4 text-size-footer">
                                Liên Kết
                            </h6>
                            <div class="border-line-footer"></div>
                            <div class="padding-bottom-footer"></div>
                            <p>
                                <a href="#!" class="text-reset">Mở Tài Khoản</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Mua Sắm & Đặt Hàng</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Ví Của Tôi</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Giá Cả</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4 text-size-footer">
                                Thông Tin Hữu Ích
                            </h6>
                            <div class="border-line-footer"></div>
                            <div class="padding-bottom-footer"></div>
                            <p>
                                <span class="text-reset">Giá Sản Phẩm</span>
                            </p>
                            <p>
                                <span class="text-reset">Cài Đặt</span>
                            </p>
                            <p>
                                <span class="text-reset">Đơn Hàng</span>
                            </p>
                            <p>
                                <span class="text-reset">Trợ Giúp</span>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4 text-size-footer">
                                Liên Hệ
                            </h6>
                            <div class="border-line-footer"></div>
                            <div class="padding-bottom-footer"></div>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i></i> 310 Lý Thường Kiệt khóm 2 phường 6,
                                TP Cà Mau</p>
                            <p>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                tructienpaint@gmail.com
                            </p>
                            <p><i class="fa fa-phone" aria-hidden="true"></i> + 01 234 567 88</p>
                            <p><i class="fa fa-phone" aria-hidden="true"></i> + 01 234 567 89</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2023 Copyright:
                <!-- <a class="text-reset fw-bold" href="https://mdbootstrap.com/"></a> -->
                <span class="text-reset">tructienpaint.com</span>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer End -->
        <!-- Liên kết Jquey -->
        <script src="plugin/jquery/jquery-3.6.0.min.js"></script>
        <!-- Liên kết Bootstrap -->
        <script src="plugin/bootstrap-4.6.1-dist/js/bootstrap.min.js"></script>
        <!-- Liên kết giao diện Jquery UI -->
        <script src="plugin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
        <script>
            $('#myList a').on('click', function(event) {
                event.preventDefault()
                $(this).tab('show')
            })
        </script>
        @yield('script')

        <!-- </body>
</html> -->