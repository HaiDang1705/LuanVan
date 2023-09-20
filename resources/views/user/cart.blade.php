@extends('user.master')
@section('title', 'Giỏ hàng')
@section('css', 'css/dangnhap.css')
@section('main')
<!---------------------------------------------------- CART START --------------------------------------------------------->
<main role="main">
    <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
    <div class="container mt-4">
        <div id="thongbao" class="alert alert-danger d-none face" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @if(Cart::count() >= 1)
        <h1 class="text-center">Giỏ hàng</h1>
        <div class="row" style="text-align: center;">
            <div class="col col-md-12">
                <form action="" method="post">
                    <div class="row" style="text-align: center;">
                        <div class="col col-md-8">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="datarow">
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>
                                            <img style="width: 60px; object-fit:contain" src="{{asset('storage/storage/avatar/'.$product->options->img)}}" class="hinhdaidien">
                                        </td>
                                        <td>{{$product->name}}</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <input class="form-control" type="number" value="{{$product->qty}}" onchange="updateCart(this.value, '{{$product->rowId}}')">
                                            </div>
                                        </td>
                                        <td class="text-right">{{number_format($product->price,0,',','.')}}đ</td>
                                        <td class="text-right">{{number_format($product->price * $product->qty,0,',','.')}}đ</td>
                                        <td>
                                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `sp_ma` -->
                                            <a href="{{asset('user/cart/delete/'.$product->rowId)}}" id="delete_1" data-sp-ma="2" class="btn btn-danger btn-delete-sanpham">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <div class="container mt-4">
                                <div class="row">
                                    <div class="col-12" style="margin-bottom: 16px;">
                                        <h1>Chi tiết</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 style="text-align: left;">Tổng số lượng:</h5>
                                    </div>
                                    <div class="col-6">
                                        <p style="font-weight: bold;">{{Cart::count()}} sản phẩm</p>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 style="text-align: left;">Tổng tiền:</h5>
                                    </div>
                                    <div class="col-6">
                                        <p style="font-weight: bold;">{{$total}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h3>Xác nhận mua hàng</h3>
                                        <form method="post">
                                            <div class="form-group" style="text-align: left;">
                                                <label style="font-weight: 700;" for="email">Email:</label>
                                                <input required type="email" class="form-control" id="email" name="email">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label style="font-weight: 700;" for="name">Họ và tên:</label>
                                                <input required type="text" class="form-control" id="name" name="name">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label style="font-weight: 700;" for="phone">Số điện thoại:</label>
                                                <input required type="number" class="form-control" id="phone" name="phone">
                                            </div>
                                            <div class="form-group" style="text-align: left;">
                                                <label style="font-weight: 700;" for="add">Địa chỉ:</label>
                                                <input required type="text" class="form-control" id="add" name="add">
                                            </div>
                                            <div class="form-group text-right" style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-danger w-20">Thanh toán khi nhận hàng</button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-danger w-20">Thanh toán online</button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{csrf_field()}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>

                <!-- <div class="col-md-8">
                    <h3>Xác nhận mua hàng</h3>
                    <form method="post">
                        <div class="form-group">
                            <label style="font-weight: 700;" for="email">Email address:</label>
                            <input required type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 700;" for="name">Họ và tên:</label>
                            <input required type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 700;" for="phone">Số điện thoại:</label>
                            <input required type="number" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 700;" for="add">Địa chỉ:</label>
                            <input required type="text" class="form-control" id="add" name="add">
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-danger w-20">Thực hiện đơn hàng</button>
                        </div>
                        {{csrf_field()}}
                    </form>
                </div> -->
                @else
                <h1>Giỏ hàng rỗng</h1>
                @endif
            </div>
            <div style="text-align: center;" class="row-md-8">
                <a href="{{asset('user/index')}}" class="btn btn-warning btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Quay
                    về trang chủ</a>
                <a href="checkout.html" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Thanh toán</a>
            </div>
        </div>
    </div>
    <!-- End block content -->
</main>
<!---------------------------------------------------- CART END    --------------------------------------------------------->
@stop
@section('script')
</body>
<script type="text/javascript">
    function updateCart(qty, rowId) {
        $.get(
            '{{asset('
            user / cart / update ')}}', {
                qty: qty,
                rowId: rowId
            },
            function() {
                location.reload();
            }
        );
    }
</script>

</html>
@stop