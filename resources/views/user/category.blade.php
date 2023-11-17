@extends('user.master')
@section('title', 'Chi tiết sản phẩm danh mục')
@section('css', 'css/index.css')
@section('main')
<!--------------------------------------------------------- Bắt đầu Thay ĐỔi ------------------------------------------------------------>
<style>
    .list-group li:hover a {
        color: white;
        font-weight: bold;
        text-decoration: none;
    }
</style>
<!-- Dòng 2 -->
<div class="row">
    <div class="col-md-3">
        <br>
        <ul class="list-group" id="" role="">
            @foreach($listcategories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center list-hover">
                <a href="{{asset('user/category/'.$category->cate_id.'/'.$category->cate_slug).'.html'}}">
                    {{$category->cate_name}}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="image/maunhapho.jpg" class="d-block w-100 hinh-slider" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="image/maunhapho_1.jpg" class="d-block w-100 hinh-slider" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="image/image-ihpone-2-index.jpg" class="d-block w-100 hinh-slider" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dòng 3 -->
<div class="row">
    <div class="col-md-12">
        <h1 class="h1-align">SẢN PHẨM GIÁ TỐT - CHỐT LIỀN TAY</h1>
    </div>
    <div class="col-md-12">
        <p class="p-align">
            Đừng vội mua nếu chưa xem giá tại
            <a class="name" href="#">Trúc Tiên Store</a>
        </p>
    </div>
</div>
<div class="row slider-margin">
    <div class="col-md-12">
        <h1 style="text-align: center; color: #f7434c !important;">{{$cateName->cate_name}}</h1>
    </div>
</div>
<!-- Dòng 4 -->
<div class="row slider-margin">
    <!-- Dòng 4 cột 1 -->
    @foreach($items as $product)
    @if($product->product_status == 1 && $product->product_quantity > 0)
    <div class="col-md-3 product-bottom">
        <div class="card">
            <img style="height: 150px;" src="{{asset('storage/storage/avatar/'.$product->product_image)}}" class="card-img-top image" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$product->product_name}}</h5>
                <p class="card-text">
                    {{$product->product_mota}}
                </p>
                <div class="row">
                    <div class="col-md-9">
                        <h4 class="card-price">{{number_format($product->product_price,0,',','.')}}đ</h4>
                    </div>
                    <div class="col-md-3">
                        <h5 class="card-quantity">SL: {{ $product->product_quantity }}</h5>
                    </div>
                </div>
                <a href="{{asset('user/detail/'.$product->product_id.'/'.$product->product_slug)}}" class="btn btn-danger w-100">THÊM VÀO GIỎ HÀNG</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
</div>

<!--------------------------------------------------------- Kết Thúc Thay ĐỔi ------------------------------------------------------------>
@stop
@section('script')
</body>

</html>
@stop