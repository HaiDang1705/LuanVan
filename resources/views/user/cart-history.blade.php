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
                <td colspan="2" style="text-align: center; color: #EB1616; font-weight: bold;">{{ number_format($totalPrice, 0, '.', ',') }} VNĐ</td>
            </tr>
        </tfoot>
    </table>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6" style="text-align: center;margin: 10px;">
            <a style="padding: 8px 20px;background: #ffc107;text-decoration: none;color: white;border-radius: 20px;" href="{{asset('user/buy-history/'.$customer->id)}}">Quay về</a>
        </div>
        <div class="col-3"></div>
    </div>
</div>
@stop
@section('script')
</body>

</html>
@stop