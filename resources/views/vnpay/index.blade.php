<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/luanvan/lib/public/vnpay">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <link rel="stylesheet" href="vnpay/bootstrap.min.css">
    <link rel="stylesheet" href="vnpay/jumbotron-narrow.css">
    <script src="vnpay/jquery-1.11.3.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY DEMO</h3>
        </div>
        <h3>Tạo mới đơn hàng</h3>
        <div class="table-responsive">
            <form action="{{ route('payment.online') }}" id="create_form" method="post">
                <div class="form-group">
                    <label for="language">Loại hàng hóa</label>
                    <select name="order_type" id="order_type" class="form-control" required>
                        <option value="topup">Nạp tiền điện thoại</option>
                        <option value="billpayment">Thanh toán hóa đơn</option>
                        <option value="fashion">Thời trang</option>
                        <option value="other">Khác - Xem thêm tại VNPAY</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="donhang">Mã hóa đơn</label>
                    <input class="form-control" id="donhang" name="donhang" type="text" value="{{ (int)$donhang - 1}}" readonly>
                </div>
                <div class="form-group">
                    <label for="tongtien">Số tiền</label>
                    <input class="form-control" id="tongtien" name="tongtien" type="number" value="{{$tongtien}}" readonly>
                </div>
                <div class="form-group">
                    <label for="order_desc">Nội dung thanh toán</label>
                    <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows='2' placeholder="Nội dung thanh toán"></textarea>
                </div>
                <div class="form-group">
                    <label for="bank_code">Ngân hàng</label>
                    <select name="bank_code" id="bank_code" class="form-control">
                        <option value="">Không chọn</option>
                        <option value="NCB">Ngan hang NCB</option>
                        <option value="AGRIBANK">Ngan hang AGRIBANK</option>
                        <option value="SCB">Ngan hang SCB</option>
                        <option value="SACOMBANK">Ngan hang SACOMBANK</option>
                        <option value="EXIMBANK">Ngan hang EXIMBANK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="language">Ngôn ngữ</label>
                    <select name="language" id="language" class="form-control">
                        <option value="vn">Tiếng Việt</option>
                        <option value="en">English</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" id="btnPopup">Xác nhận thanh toán</button>
                {{csrf_field()}}
            </form>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY 2021</p>
        </footer>
    </div>
    <link rel="stylesheet" href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css">
    <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
    <!-- <script type="text/javascript">
        $("#btnPopup").click(function () {
            var postData = $("#create_form").serialize();
            var submitUrl = $("#create_form").attr("action");
            $.ajax({
                type: "POST",
                url: submitUrl,
                data: postData,
                dataType: 'JSON',
                success: function (x) {
                    console.log(x.data)
                    if(x.code === '00') {
                        location.href = x.data;
                        return false;
                    } else {
                        alert(x.Message);
                    }
                }
            });
        });
    </script> -->
    <script>
        document.getElementById('btnPopup').addEventListener('click', function() {
            // Lấy giá trị của các trường cần truyền cho VNPAY
            var orderType = document.getElementById('order_type').value;
            var orderId = document.getElementById('donhang').value;
            var tongtien = document.getElementById('tongtien').value;
            var orderDesc = document.getElementById('order_desc').value;
            var bankCode = document.getElementById('bank_code').value;
            var language = document.getElementById('language').value;

            // Tạo URL của VNPAY với các tham số tương ứng
            var vnpUrl = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            vnpUrl += "?order_type=" + orderType;
            vnpUrl += "&donhang=" + orderId;
            vnpUrl += "&tongtien=" + tongtien;
            vnpUrl += "&order_desc=" + orderDesc;
            vnpUrl += "&bank_code=" + bankCode;
            vnpUrl += "&language=" + language;

            // Chuyển hướng đến trang thanh toán của VNPAY
            window.location.href = vnpUrl;
        });
    </script>

</body>

</html>