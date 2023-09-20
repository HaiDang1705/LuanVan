@extends('user.master')
@section('title', 'Tìm kiếm')
@section('css', 'css/index.css')
@section('main')
<!--------------------------------------------------------- Bắt đầu Thay ĐỔi ------------------------------------------------------------>
<style>
    .list-group li:hover a {
        color: white;
        font-weight: bold;
        text-decoration: none;
    }

    a:hover .an{
        color: #f7434c !important;
    }
    .na:hover{
        text-decoration: none;
    }
</style>
<!-- Dòng 4 -->
<div class="row slider-margin">
    <a class="na" href="{{asset('/')}}">
        <h4 style="color: #f7434c !important;" class="an row-margin">TÌM KIẾM THEO TỪ KHÓA: <span style="font-weight:bold;">{{$keyword}}</span></h4>
        <div class="border-line"></div>
    </a>
</div>
<div class="row slider-margin">
    <!-- Dòng 4 cột 1 -->
    @foreach($items as $product)
    <div class="col-md-3 product-bottom">
        <div class="card">
            <img style="height: 150px;" src="{{asset('storage/storage/avatar/'.$product->product_image)}}" class="card-img-top image" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$product->product_name}}</h5>
                <p class="card-text">
                    {{$product->product_mota}}
                </p>
                <h4 class="card-price">{{number_format($product->product_price,0,',','.')}}đ</h4>
                <a href="{{asset('user/detail/'.$product->product_id.'/'.$product->product_slug)}}" class="btn btn-danger w-100">THÊM VÀO GIỎ HÀNG</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <div id="pagination">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="{{asset('/')}}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item disabled"><a class="page-link" href="{{asset('/')}}">1</a></li>
                <li class="page-item"><a class="page-link" href="{{asset('/')}}">2</a></li>
                <li class="page-item"><a class="page-link" href="{{asset('/')}}">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="{{asset('/')}}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
<!--------------------------------------------------------- Kết Thúc Thay ĐỔi ------------------------------------------------------------>
@stop
@section('script')
</body>

</html>
@stop