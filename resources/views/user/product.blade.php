@extends('user.master')
@section('title', 'Trang chủ')
@section('css', 'css/sanpham.css')
@section('main')
<!-- Dòng 2 -->
<div class="container">
    <div class="row">
        <div class="col-md-12 row-flex">
            <a class="a-hover" href="index.html">
                <h4 class="row-margin">TRANG CHỦ</h4>
                <div class="border-line"></div>
            </a>
            <a class="a-hover" href="#">
                <!-- <h4 class="row-margin">{{$product->product_cate}}</h4> -->
                <h4 class="row-margin">{{$product->product_cate}}</h4>
                <div class="border-line"></div>
            </a>
            <h4 class="row-margin h4-color">{{$product->product_name}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <img class="image" src="{{asset('storage/storage/avatar/'.$product->product_image)}}" width="500" height="300" alt="#">
        </div>
        <div class="col-md-6 col-padd">
            <div class="card card-width">
                <div class="card-body">
                    <h2 class="card-title">{{$product->product_name}}</h2>
                    <div class="border-line-1"></div>
                    <h6 class="card-subtitle mb-2 text-dark">{{number_format($product->product_price,0,',','.')}} VNĐ</h6>
                    <p class="card-text">
                        Bảo hàng 1 năm
                    </p>
                    <a href="{{asset('user/cart')}}" class="btn-danger w-40 button-css button-left">THÊM VÀO GIỎ HÀNG</a>
                    <!-- <a href="#" class="btn-danger w-40 button-css">THANH TOÁN</a> -->
                    <div class="border-line-2 padding-top"></div>
                    <p>Danh mục: <a class="font-a" href="#">{{$product->product_cate}}</a></p>
                    <div class="border-line-2"></div>
                    <p>Từ khóa:
                        @foreach($listcategories as $category)
                        <a class="font-a a-style" href="#">{{$category->cate_name}}</a>,
                        @endforeach ...
                    </p>
                    <div>
                        <a href="" class="me-4 text-reset text-hover">
                            <i class="fa fa-facebook fa-icon" aria-hidden="true"></i>
                        </a>
                        <a href="" class="me-4 text-reset text-hover">
                            <i class="fa fa-twitter fa-icon" aria-hidden="true"></i>
                        </a>
                        <a href="" class="me-4 text-reset text-hover">
                            <i class="fa fa-envelope-o fa-icon" aria-hidden="true"></i>
                        </a>
                        <a href="" class="me-4 text-reset text-hover">
                            <i class="fa fa-google fa-icon" aria-hidden="true"></i>
                        </a>
                        <a href="" class="me-4 text-reset text-hover">
                            <i class="fa fa-instagram fa-icon" aria-hidden="true"></i>
                        </a>
                        <a href="" class="me-4 text-reset text-hover">
                            <i class="fa fa-linkedin fa-icon" aria-hidden="true"></i>
                        </a>
                        <a href="" class="me-4 text-reset text-hover">
                            <i class="fa fa-github fa-icon" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dòng 3 -->
<div class="container-fluid ctn-color">
    <div class="row">
        <div class="col-md-12">
            <!-- <h3 class="h3-css">MÔ TẢ</h3> -->
            <h4 class="h4-css">{{$product->product_name}}</h4>
            <p class="p-css">{{$product->product_mota}}</p>
        </div>
    </div>
</div>
<!-- Gửi bình luận cho admin -->
<!-- Dòng 4 -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="comment">
                <h3 style="color: #dc3545;margin-top:10px;">Bình luận</h3>
                <div class="col-md-9 comment">
                    <form method="post">
                        <div class="form-group">
                            <label style="font-weight: bold;" for="email">Email:</label>
                            <input required type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold;" for="name">Tên:</label>
                            <input required type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold;" for="cm">Bình luận:</label>
                            <textarea required rows="10" id="cm" class="form-control" name="content"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button style="background: #dc3545; color: white; font-weight: bold;" type="submit" class="btn btn-default">Gửi</button>
                        </div>
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
            <!-- Hiển thị bình luận -->
            <!-- <div id="comment-list">
                foreach(comments as comment)
                <ul>
                    <li style="font-weight: bold;" class="com-title">
                        comment->com_name
                        <br>
                        <span style="font-weight: normal;opacity: 0.5;">date('d/m/Y H:i',strtotime(comment->created_at))</span>
                    </li>
                    <li style="list-style: none;" class="com-details">
                        comment->com_content
                    </li>
                </ul>
                endforeach
            </div> -->
        </div>
    </div>
</div>
<!-- </div> -->

@stop
@section('script')
</body>

</html>
@stop