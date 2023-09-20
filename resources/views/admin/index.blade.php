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
                    <p class="mb-2">Tổng ứng viên</p>
                    <h6 class="mb-0">10</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng nhà tuyển dụng</p>
                    <h6 class="mb-0">30</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Công việc đã đăng</p>
                    <h6 class="mb-0">100</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Lượt ứng tuyển</p>
                    <h6 class="mb-0">200</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-------------------------------------------- BẮT ĐẦU THAY ĐỔI NỘI DUNG ---------------------->
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;color: #EB1616;">KẾT QUẢ DOANH THU THEO NĂM</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">STT</th>
                        <th scope="col">TÊN SẢN PHẨM</th>
                        <th scope="col">LOẠI SẢN PHẨM</th>
                        <th scope="col">SỐ LƯỢNG ĐƠN ĐẶT HÀNG</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-white">
                        <td>1</td>
                        <td>INV-0123</td>
                        <td>Iphone</td>
                        <td>300</td>
                    </tr>
                    <tr class="text-white">
                        <td>2</td>
                        <td>INV-0123</td>
                        <td>Iphone</td>
                        <td>300</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
<!-------------------------------------------- KẾT THÚC THAY ĐỔI NỘI DUNG ---------------------->

<!-- <script>
    $(document).ready(function() {
        $("#thongke a").click(function() {
            // Loại bỏ lớp active từ tất cả các liên kết trong phần tử có id "thongke"
            $("#thongke a").removeClass("active");
            // Thêm lớp active vào liên kết vừa được nhấp
            $(this).addClass("active");
        });
    });
</script> -->
@stop

@section('script')
<!-- <script>
    $(document).ready(function() {
        $("#thongke a").click(function() {
            // Loại bỏ lớp active từ tất cả các liên kết trong phần tử có id "thongke"
            $("#thongke a").removeClass("active");
            // Thêm lớp active vào liên kết vừa được nhấp
            $(this).addClass("active");
        });
    });
</script> -->
</body>
</html>
@stop