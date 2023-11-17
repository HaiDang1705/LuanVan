@extends('admin.master')
@section('title', 'Chi tiết đơn hàng')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        @include('errors.note')
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">THÔNG TIN ĐƠN HÀNG</h6>
            <a href="{{ route('sendMail', ['id' => $order->shipping_id]) }}" class="mb-0" style="color: #EB1616; margin-right: 20px">GỬI MAIL</a>
            <a href="{{asset('/admin/donhang/printorder/'.$order->shipping_id)}}" class="mb-0" style="color: #EB1616;">IN HÓA ĐƠN</a>
        </div>
        <!-- Thông tin chủ đơn hàng -->
        <div class="table-responsive" style="margin-bottom: 20px;">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">MÃ ĐƠN HÀNG</th>
                        <th scope="col">THỜI GIAN ĐẶT HÀNG</th>
                        <th scope="col">TÊN KHÁCH HÀNG</th>
                        <th scope="col">SỐ ĐIỆN THOẠI</th>
                        <th scope="col">ĐỊA CHỈ</th>
                        <!-- <th scope="col">TRẠNG THÁI ĐƠN HÀNG</th>
                                    <th scope="col">TRẠNG THÁI THANH TOÁN</th> -->
                        <!-- <th scope="col">TÙY CHỌN</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-white">
                        <td>{{$order->shipping_id}}</td>
                        <td>
                            {{$order->created_at}}
                        </td>
                        <td>{{$order->shipping_name}}</td>
                        <td>{{$order->shipping_phone}}</td>
                        <td>{{$order->shipping_address}}</td>
                        <!-- <td>Đã xác nhận</td>
                                    <td>
                                        Chưa thanh toán
                                    </td> -->
                        <!-- <td>
                                        <a href="chitiet_donhang.html" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Chi tiết</a>
                                    </td> -->
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Thông tin đơn hàng -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">CHI TIẾT ĐƠN HÀNG</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">HÌNH ẢNH</th>
                        <th scope="col">TÊN SẢN PHẨM</th>
                        <th scope="col">SỐ LƯỢNG</th>
                        <th scope="col">GIÁ TIỀN</th>
                        <th scope="col">THÀNH TIỀN</th>
                    </tr>
                </thead>
                @php
                $counter = 1;
                @endphp
                <tbody>
                    @foreach($orderdetails as $orderdetail)
                    <tr class="text-white">
                        <td>{{$counter}}</td>
                        <td>
                            <!-- Trong đoạn mã trên:
                            1. Chúng ta sử dụng json_decode để phân tích chuỗi JSON trong trường "image" thành một đối tượng.
                            2. Sau đó, chúng ta sử dụng đối tượng đã phân tích để truy cập đường dẫn hình ảnh và tạo đường dẫn hoàn chỉnh với asset.
                            Bằng cách này, bạn sẽ truy cập đúng đường dẫn ảnh từ chuỗi JSON trong trường "image" của mục giỏ hàng. -->
                            @php
                            $imageData = json_decode($orderdetail->image);
                            $imgPath = asset('storage/storage/avatar/'.$imageData->img);
                            @endphp
                            <img height="100px" src="{{ $imgPath }}" alt="">
                        </td>
                        <!-- Hiển thị tên sản phẩm từ danh sách product_names -->
                        <td>{{$product_names[$counter - 1]}}</td>
                        <td>{{$orderdetail->quantity}}</td>
                        <td>{{number_format($orderdetail->price,0,',','.')}} VNĐ</td>
                        <td>{{number_format($orderdetail->price*$orderdetail->quantity,0,',','.')}} VNĐ</td>
                    </tr>
                    @php
                    $counter++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616; margin-top:20px">TỔNG: {{ number_format(floatval(str_replace(',', '', $order->shipping_total)), 0, ',', '.') }} VNĐ</h6>
            </div>
            <form action="" method="post">
                <div>
                    <select required name="states" id="">
                        <!--  -->
                        <!--  -->
                        @foreach($liststates as $states)
                        <option value="{{$states->states_id}}" @if($order->
                            shipping_states == $states->states_id) selected @endif>
                            {{$states->states_name}}
                        </option>
                        @endforeach
                    </select>
                    <input name="submit" type="submit" class="btn btn-primary" style="margin-left:20px;" value="Duyệt"></input>
                </div>
                {{csrf_field()}}
            </form>
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
        $(".navbar-nav .fa-cart-plus").parent().addClass("active");
    });
</script>
</body>

</html>
@stop