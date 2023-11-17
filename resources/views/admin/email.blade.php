<p>Xin chào {{ $order->shipping_name }},</p>
<p>Cảm ơn bạn đã đặt hàng. Chúng tôi đã duyệt và đơn hàng của bạn đã được gửi đi!</p>

<div id="wrap-inner">
    <div id="khach-hang">
        <h3>Thông tin khách hàng</h3>
        <p>
            <span class="info">Khách hàng: </span>
            {{ $order->shipping_name }}
        </p>
        <p>
            <span class="info">Email: </span>
            {{ $order->shipping_email }}
        </p>
        <p>
            <span class="info">Điện thoại: </span>
            {{ $order->shipping_phone }}
        </p>
        <p>
            <span class="info">Địa chỉ: </span>
            {{ $order->shipping_address }}
        </p>
    </div>
    <div id="hoa-don">
        <h3>Hóa đơn mua hàng</h3>
        <table class="table-bordered table-responsive">
            <tr class="bold">
                <td width="30%">Tên sản phẩm</td>
                <td width="25%">Giá</td>
                <td width="20%">Số lượng</td>
                <td width="15%">Thành tiền</td>
            </tr>
            @foreach($order->orderDetail as $item)
            <tr>
                <td>{{$item->product->product_name}}</td>
                <td class="price">{{number_format($item->price)}}VNĐ</td>
                <td>{{$item->quantity}}</td>
                <td class="price">{{number_format($item->price*$item->quantity,0,',','.')}} VNĐ</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">Tổng tiền:</td>
                <td class="total-price">{{number_format($order->shipping_total,0,',','.')}} VNĐ</td>
            </tr>
        </table>
    </div>
    <div id="xac-nhan">
        <br>
        <p style="text-align:justify">
            <b>Quý khách đã đặt hàng thành công!</b><br />
            • Sản phẩm của Quý khách sẽ được chuyển đến địa chỉ có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
            • Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số điện thoại trước khi giao hàng 24 tiếng.<br />
            <b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng tôi. Xin chân thành cảm ơn quý khách!</b>
        </p>
    </div>
</div>
<!-- end main -->
<!-- Thêm thông tin chi tiết đơn hàng nếu cần -->