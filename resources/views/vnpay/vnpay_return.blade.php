<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/luanvan/lib/public/vnpay">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="vnpay/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="vnpay/jumbotron-narrow.css" rel="stylesheet">
    <script src="vnpay/jquery-1.11.3.min.js"></script>
</head>

<body>
    <!--Begin display -->
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY RESPONSE</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã đơn hàng:</label>

                <label> {{ $vnpayData['vnp_TxnRef'] - 1 }}</label>
            </div>
            <div class="form-group">

                <label>Số tiền:</label>
                <label> {{ $vnpayData['vnp_Amount'] }}</label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label> {{ $vnpayData['vnp_OrderInfo'] }}</label>
            </div>
            <div class="form-group">
                <label>Mã phản hồi:</label>
                <label> {{ $vnpayData['vnp_ResponseCode'] }}</label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label> {{ $vnpayData['vnp_TransactionNo'] }}</label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label> {{ $vnpayData['vnp_BankCode'] }}</label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label> {{ $vnpayData['vnp_PayDate'] }}</label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>
                    <?php
                    if ($vnpayData['vnp_ResponseCode'] == '00') {
                        echo "<span style='color:blue'>GD Thanh cong</span>";
                    } else {
                        echo "<span style='color:red'>GD Khong thanh cong</span>";
                    }
                    ?>
                </label>
                <br>
                <a href="{{asset('user/cart/show')}}">
                    <button>Quay lại</button>
                </a>
            </div>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY <?php echo date('Y') ?></p>
        </footer>
    </div>
</body>

</html>