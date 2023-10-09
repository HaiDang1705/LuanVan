@extends('user.master')
@section('title', 'Giỏ hàng')
@section('css', 'css/dangnhap.css')
@section('main')
<div class="container">
    <h2>Lịch sử mua hàng</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartHistory as $cartItem)
                <tr>
                    <td>
                        <img src="{{ asset('storage/storage/avatar/'.$cartItem->image) }}" alt="Sản phẩm" width="100">
                    </td>
                    <td>{{ $cartItem->quantity }}</td>
                    <td>{{ $cartItem->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
@section('script')
</body>

</html>
@stop