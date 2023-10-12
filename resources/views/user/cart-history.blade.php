@extends('user.master')
@section('title', 'Chi tiết đơn hàng')
@section('css', 'css/dangnhap.css')
@section('main')
<div class="container">
    <h2>Chi tiết đơn hàng</h2>
    <div style="width: 300px; margin-bottom: 20px" class="border-line-footer"></div>
    <table class="table text-start align-middle table-bordered table-hover mb-0" style="margin-bottom: 20px;">
        <thead style="text-align: center;">
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                <th>Thời gian đặt</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            @php
            $totalPrice = 0; // Tạo biến để tính tổng giá trị đơn hàng
            $counter = 1;
            @endphp
            @foreach($orderDetails as $orderDetail)
            <tr>
                <td style="padding: 50px 0;">{{$counter}}</td>
                <td>
                    @php
                    $imageData = json_decode($orderDetail->image);
                    $imgPath = asset('storage/storage/avatar/'.$imageData->img);
                    @endphp
                    <img height="100px" src="{{ $imgPath }}" alt="Sản phẩm">
                </td>
                <td style="padding: 50px 0;">{{ $orderDetail->quantity }}</td>
                <td style="padding: 50px 0;">{{ number_format($orderDetail->price, 0, '.', ',') }} VNĐ</td>
                <td style="padding: 50px 0;">{{ number_format($orderDetail->price * $orderDetail->quantity, 0, '.', ',') }} VNĐ</td>
                <td style="padding: 50px 0;">{{ $orderDetail->created_at }}</td>
                @php
                $totalPrice += $orderDetail->price * $orderDetail->quantity;
                $counter++;
                @endphp
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end" style="text-align: center;">Tổng giá trị:</td>
                <td colspan="2" style="text-align: center;">{{ number_format($totalPrice, 0, '.', ',') }} VNĐ</td>
            </tr>
        </tfoot>
    </table>
</div>
@stop
@section('script')
</body>

</html>
@stop