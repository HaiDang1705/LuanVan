@extends('admin.master')
@section('title', 'Trang chủ Admin')
@section('main')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Số sản phẩm</p>
                    <h6 class="mb-0">{{ $totalProducts }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng doanh thu</p>
                    <h6 class="mb-0">{{$totalDoanhThu}} VNĐ</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng lợi nhuận</p>
                    <h6 class="mb-0">{{$totalLoiNhuan}} VNĐ</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Số đơn hàng</p>
                    <h6 class="mb-0">{{$totalOrders}}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4" style="margin-top: 5px;">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Số sản phẩm bán</p>
                    <h6 class="mb-0">{{$totalSoldProducts}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Số bài đăng</p>
                    <h6 class="mb-0">{{ $totalPosts }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Số khách hàng</p>
                    <h6 class="mb-0">{{$totalCustomers}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng lượt xem</p>
                    <h6 class="mb-0">{{$totalView}}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4" style="margin-top: 5px;">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng sản phẩm tồn</p>
                    <h6 class="mb-0">{{$totalProductsKho}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng sản phẩm xuất</p>
                    <h6 class="mb-0">{{$totalMinusProductsKho}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Số bình luận</p>
                    <h6 class="mb-0">{{$totalComments}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng lượt xem</p>
                    <h6 class="mb-0"></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-------------------------------------------- BẮT ĐẦU THAY ĐỔI NỘI DUNG ---------------------->
<!-- Recent Sales Start -->
<!-- Biểu đồ thống kê doanh số/lợi nhuận -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;color: #EB1616;">THỐNG KÊ DOANH SỐ / LỢI NHUẬN BÁN HÀNG</h6>
        </div>
        <div class="align-items-center justify-con  tent-between mb-4">
            <form autocomplete="off" action="">
                <div class="row">
                    <div class="col-2" style="text-align: left;">
                        <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                        <input type="button" name="submit" class="btn btn-primary btn-sm" id="btn-dashboard-filter" value="Lọc kết quả">
                    </div>
                    <div class="col-2" style="text-align: left;">
                        <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                    </div>
                    <div class="col-2" style="text-align: left;">
                        <p>
                            Lọc theo:
                            <select id="filter-select" class="dashboard-filter form-control" style="text-align: center;">
                                <option>--Chọn--</option>
                                <option value="7ngay">7 ngày qua</option>
                                <option value="thangtruoc">Tháng này</option>
                                <option value="365ngayqua">365 ngày qua</option>
                            </select>
                        </p>
                    </div>
                </div>
                {{csrf_field()}}
            </form>
        </div>
        <!-- BIểu đồ -->
        <div class="col-md-12">
            <div id="myfirstchart"></div>
        </div>
    </div>
</div>
<!-- Biểu đồ thống kê đơn nhập hàng -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;color: #EB1616;">THỐNG KÊ ĐƠN NHẬP HÀNG</h6>
        </div>
        <div class="align-items-center justify-con  tent-between mb-4">
            <form autocomplete="off" action="">
                <div class="row">
                    <div class="col-2" style="text-align: left;">
                        <p>Từ ngày: <input type="text" id="datepicker3" class="form-control"></p>
                        <input type="button" name="submit" class="btn btn-primary btn-sm" id="btn-dashboard-filter" value="Lọc kết quả">
                    </div>
                    <div class="col-2" style="text-align: left;">
                        <p>Đến ngày: <input type="text" id="datepicker4" class="form-control"></p>
                    </div>
                    <div class="col-2" style="text-align: left;">
                        <p>
                            Lọc theo:
                            <select id="filter-select1" class="dashboard-filter form-control" style="text-align: center;">
                                <option>--Chọn--</option>
                                <option value="7ngay">7 ngày qua</option>
                                <option value="thangtruoc">Tháng này</option>
                                <option value="365ngayqua">365 ngày qua</option>
                            </select>
                        </p>
                    </div>
                </div>
                {{csrf_field()}}
            </form>
        </div>
        <!-- BIểu đồ -->
        <div class="col-md-12">
            <div id="mysecondchart"></div>
        </div>
    </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;color: #EB1616;">TOP 5 SẢN PHẨM BÁN CHẠY</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">TÊN SẢN PHẨM</th>
                        <th scope="col">SỐ LƯỢNG ĐÃ BÁN</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach ($bestSellingProducts as $key => $product)
                    <tr>
                        <td style="color: #ccc">{{ $key + 1 }}</td>
                        <td style="color: #ccc">{{ $product['product_name'] }}</td>
                        <td style="color: #ccc">{{ $product['total_sold'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Lượt xem nhiều -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="">
            <div class="row">
                <div class="col-4">
                    <div style="background-color: #191C24 !important;;" id="myChart" style="width:100%; max-width:600px; height:500px;">
                    </div>
                </div>
                <!-- Thống kê các bài viết nào được xem nhiều -->
                <div class="col-4">
                    <div class="align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #EB1616;">BÀI VIẾT XEM NHIỀU</h6>
                        <ol class="list_views">
                            @foreach($post_views as $post)
                            <li style="text-align: left;">
                                <a style="color: #ccc;margin-left: 10px;" href="{{asset('user/news/baidang/'.$post->post_id)}}">{{$post->post_name}} | <span style="color: yellow;">{{$post->post_view}}</span></a>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <!-- Thống kê các sản phẩm nào được xem nhiều -->
                <div class="col-4">
                    <div class="align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #EB1616;">SẢN PHẨM XEM NHIỀU</h6>
                        <ol class="list_views">
                            @foreach($product_views as $product)
                            <li style="text-align: left;">
                                <a style="color: #ccc;margin-left: 10px;" href="{{asset('user/detail/'.$product->product_id.'/'.$product->product_slug)}}">{{$product->product_name}} | <span style="color: yellow;">{{$product->product_view}}</span></a>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
<!-------------------------------------------- KẾT THÚC THAY ĐỔI NỘI DUNG ---------------------->


@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<!-- <script>
    // Dữ liệu mẫu cho biểu đồ
    var sampleData = [
        { y: '2023-01-01', a: 50 },
        { y: '2023-01-02', a: 75 },
        { y: '2023-01-03', a: 30 },
        // Thêm dữ liệu cho các ngày khác ở đây
    ];

    // Khởi tạo biểu đồ Morris
    var chart = Morris.Line({
        element: 'mysecondchart', // ID của phần tử để vẽ biểu đồ
        data: sampleData,
        xkey: 'y', // Trường chứa dữ liệu thời gian (ngày)
        ykeys: ['a'], // Trường chứa dữ liệu giá trị
        labels: ['Giá trị'], // Nhãn cho dữ liệu
        xLabels: "day",
        parseTime: false,
        hideHover: 'auto',
        resize: true,
        lineColors: ['#EB1616']
    });

    // Xử lý sự kiện khi người dùng click vào nút "Lọc kết quả"
    document.getElementById('btn-dashboard-filter').addEventListener('click', function () {
        // Lấy ngày bắt đầu và kết thúc từ input
        var fromDate = document.getElementById('datepicker').value;
        var toDate = document.getElementById('datepicker2').value;

        // Thực hiện lọc dữ liệu theo khoảng thời gian được chọn
        var filteredData = sampleData.filter(function (item) {
            return item.y >= fromDate && item.y <= toDate;
        });

        // Cập nhật dữ liệu cho biểu đồ
        chart.setData(filteredData);
    });
</script> -->

<script>
    var doanhSoData = @json($doanhSoData);
    var chart = Morris.Bar({
        element: 'myfirstchart',
        data: doanhSoData, // Sử dụng biến JSON
        xkey: 'created_at',
        ykeys: ['doanh_so', 'loi_nhuan', 'tong_sanpham'],
        labels: ['Doanh số', 'Lợi nhuận', 'Tổng sản phẩm'],
        parseTime: false,
        xLabels: "day",
        hideHover: 'auto',
        resize: true,
        lineColors: ['#EB1616', '#34A853', '#34A850'],
    });

    // Xử lý sự kiện khi người dùng click vào nút "Lọc kết quả"
    document.getElementById('btn-dashboard-filter').addEventListener('click', function() {
        var fromDate = document.getElementById('datepicker').value;
        var toDate = document.getElementById('datepicker2').value;

        var filterSelect = document.getElementById('filter-select').value;

        // Tính toán ngày bắt đầu và ngày kết thúc dựa vào lựa chọn
        if (filterSelect === '7ngay') {
            // Tính ngày 7 ngày trước
            var sevenDaysAgo = new Date();
            sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
            fromDate = sevenDaysAgo.toISOString().split('T')[0];
            toDate = new Date().toISOString().split('T')[0]; // Cập nhật toDate thành ngày hiện tại
            // Loại bỏ thời gian khỏi fromDate
            fromDate = fromDate.split('T')[0];
        } else if (filterSelect === 'thangtruoc') {
            // Tính ngày đầu của tháng hiện tại
            var today = new Date();
            fromDate = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
            toDate = new Date().toISOString().split('T')[0]; // Cập nhật toDate thành ngày hiện tại
            fromDate = fromDate.split('T')[0];
        } else if (filterSelect === '365ngayqua') {
            // Tính ngày 365 ngày trước
            var threeSixtyFiveDaysAgo = new Date();
            threeSixtyFiveDaysAgo.setDate(threeSixtyFiveDaysAgo.getDate() - 365);
            fromDate = threeSixtyFiveDaysAgo.toISOString().split('T')[0];
            toDate = new Date().toISOString().split('T')[0]; // Cập nhật toDate thành ngày hiện tại
            fromDate = fromDate.split('T')[0];
        }

        // Thực hiện truy vấn cơ sở dữ liệu và cập nhật biểu đồ
        $.ajax({
            url: '{{url("admin/index/filter")}}', // Điều này cần được định nghĩa trong routes.php
            data: {
                from_date: fromDate,
                to_date: toDate
            },
            type: 'GET',
            success: function(data) {
                chart.setData(data);
            }
        });
    });
</script>

<script>
    var nhapKhoData = @json($nhapKhoData);
    var chart = Morris.Bar({
        element: 'mysecondchart',
        data: nhapKhoData, // Sử dụng biến JSON
        xkey: 'created_at',
        ykeys: ['tong_nhap', 'tong_sanphamnhap'],
        labels: ['Tổng nhập kho', 'Tổng sản phẩm nhập'],
        parseTime: false,
        xLabels: "day",
        hideHover: 'auto',
        resize: true,
        lineColors: ['#EB1616', '#34A853'],
    });
</script>
<!-- <script type="text/javascript">
    $(function() {
        $("#datepicker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });
        $("#datepicker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });
    });
</script> -->

<script type="text/javascript">
    // $(document).ready(function(){

    //     chart30daysorder();
    //     var chart = new Morris.Bar({
    //         element: 'myfirstchart',

    //         lineColors: ['#819C79', "#fc8710", "#FF6541", "#A4ADD3", "#766B56"],

    //         pointFillColors: ['#ffffff'],
    //         pointStrokeColor: ['black'],
    //         fillOpacity: 0.6,
    //         hideHover: 'auto',
    //         parseTime: false,
    //         xkey: 'perior',
    //         ykeys: ['order', 'sales', 'profit', 'quantity'],
    //         behaveLikeline: true,
    //         labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']
    //     });

    //     function chart30daysorder(){

    //     }

    //     $('#btn-dashboard-filter').click(function() {
    //         alert('Da nhan');
    //         var _token = $('input[name="_token').val();

    //         var from_date = $('#datepicker').val();
    //         var to_date = $('#datepicker2').val();

    //         // alert(from_date);
    //         // alert(to_date);
    //         $.ajax({
    //             url:"{{url('admin/index')}}",
    //             method:"POST",
    //             dataType:"JSON",
    //             data:{from_date: from_date, to_date: to_date, _token: _token},

    //             success:function(data)
    //             {
    //                 chart.setData(data);
    //             }
    //         });
    //     });
    // });
</script>

<!-- Biểu đồ hình tròn -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    var piedata = @json($piedataJson);
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        // Set Data
        const data = google.visualization.arrayToDataTable(<?php echo $piedataJson; ?>);

        // Set Options
        const options = {
            title: 'THỐNG KÊ SỐ LƯỢNG SẢN PHẨM'
        };

        // Draw
        const chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);

    }
</script>

</body>

</html>
@stop