@extends('user.master')
@section('title', 'Giỏ hàng')
@section('css', 'css/dangnhap.css')
@section('main')
<div class="container">
    <h2>Lịch sử mua hàng</h2>
    <div style="width: 300px; margin-bottom: 20px" class="border-line-footer"></div>
    @include('errors.note')
    @if(count($buyHistory) > 0)
    <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead style="text-align: center;">
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Tổng giá trị</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            @php
            $counter = 1;
            @endphp
            @foreach($buyHistory as $order)
            <tr>
                <td>{{$counter}}</td>
                <td>{{$order->shipping_id}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{ number_format($order->shipping_total, 0, '.', ',') }} VNĐ</td>
                <td>
                    @if($order->shipping_states == 1)
                    Chưa xử lý - Chưa giao hàng
                    @else
                    Đã xử lý - Đang giao hàng
                    @endif
                </td>
                <td>
                    <a href="{{asset('user/cart-history/'.$order->shipping_id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Chi tiết</a>
                    @if($order->shipping_states == 1)
                    <a class="btn btn-sm btn-primary" href="{{asset('user/buy-history/delete/'.$order->shipping_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Hủy đơn</a>
                    @endif
                </td>
            </tr>
            @php
            $counter++;
            @endphp
            @endforeach
        </tbody>
    </table>
    @else
    <p class="alert alert-success">Hãy đặt hàng đi nào !</p>
    @endif
</div>
@stop
@section('script')
</body>

</html>
@stop