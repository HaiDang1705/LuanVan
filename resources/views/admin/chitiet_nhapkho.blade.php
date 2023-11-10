@extends('admin.master')
@section('title', 'Chi tiết đơn nhập hàng')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">CHI TIẾT ĐƠN NHẬP HÀNG</h6>
        </div>
        <div class="">
            <div class="row">
                <div class="col-12">
                    @include('errors.note')
                    <form id="signupForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="">
                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Mã đơn nhập hàng <span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input required name="madon" style=" text-align: left !important;" type="text" class="form-control" placeholder="Nhập mã đơn nhập hàng" value="{{$donnhap->nhapkho_ma}}">
                            </div>
                        </div>

                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Người nhập đơn<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input required name="name" type="text" class="form-control" placeholder="Tên người nhập" value="{{$donnhap->nhapkho_name}}">
                            </div>
                        </div>

                        <!-- <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Tổng tiền<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input required name="total" id="total" type="number" class="form-control" placeholder="Tổng tiền">
                            </div>
                        </div> -->

                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Nội dung đơn<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <textarea required name="description" id="" cols="70" rows="10" placeholder="{{$donnhap->nhapkho_description}}"></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('description', {
                                        language: 'vi',
                                        filebrowserImageBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Images',
                                        filebrowserFlashBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Flash',
                                        filebrowserImageUploadUrl: '../../editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl: '../../public/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                    });
                                </script>
                            </div>
                        </div>
                        <!--  -->

                        <div class="row">
                            <div class="col-12" style="margin: 10px 0">
                                <div class="form-group row" style=" text-align: left !important;">
                                    <div class="col-sm-6">
                                        <label for="">Dữ liệu nhập hàng<span style="color: red;">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive" style="margin-bottom: 10px;">
                                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr class="text-white">
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Nhà cung cấp</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá nhập</th>
                                                <th scope="col">Thành tiền</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach($donnhapdetails as $donnhapdetail)
                                            <tr style="text-align: center;">
                                                <td>
                                                    <!-- <select required name="product_name[]" class="product-select" data-product-id="{{$donnhapdetail->product_id}}">
                                                        <option value="{{$donnhapdetail->product->product_id}}" selected>{{$donnhapdetail->product->product_name}}</option>
                                                    </select> -->
                                                    {{$donnhapdetail->product->product_name}}
                                                </td>
                                                <td>
                                                    {{$donnhapdetail->product->brand->brand_name}}
                                                </td>
                                                <td>
                                                    <div class="productInfo">
                                                        <input style="display: none;" type="text" name="image[]" placeholder="Ảnh sản phẩm" value="{{$donnhapdetail->image}}">
                                                        <img class="product-image" width="70px" src="{{asset('storage/storage/avatar/'.$donnhapdetail->image)}}" alt="">
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$donnhapdetail->quantity}}
                                                </td>
                                                <td class="product-price">
                                                    {{ number_format($donnhapdetail->price) }} VNĐ
                                                </td>
                                                <td>
                                                    {{ number_format($donnhapdetail->price * $donnhapdetail->quantity) }} VNĐ
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="total" style="color: red;">Tổng tiền nhập: {{ number_format($donnhap->nhapkho_total) }} VNĐ</label>
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>
                        <div class="row">
                            <div class="">
                                <a href="{{asset('admin/nhap')}}" class="btn btn-primary">Quay lại</a>
                            </div>
                        </div>
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
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


<script>
    // Lắng nghe sự kiện khi số lượng hoặc đơn giá thay đổi
    var productRows = document.querySelectorAll('.template-row');

    productRows.forEach(function(row) {
        var quantityInput = row.querySelector('.product-quantity');
        var priceTd = row.querySelector('.product-price');
        var totalInput = row.querySelector('.product-total');

        quantityInput.addEventListener('input', updateTotal);
        priceTd.addEventListener('input', updateTotal);

        // Khởi tạo tổng giá trị ban đầu
        updateTotal();

        function updateTotal() {
            var quantity = parseFloat(quantityInput.value);
            var price = parseFloat(priceTd.innerText.replace(/[^0-9.-]+/g, '')); // Loại bỏ ký tự không phải số

            var total = quantity * price;
            totalInput.value = total; // Giữ 2 chữ số thập phân
        }
    });
</script>

<!-- Lấy image = name="image" -->
<script>
    // Lắng nghe sự kiện khi select thay đổi
    var selects = document.querySelectorAll('select.product-select');
    selects.forEach(function(select) {
        select.addEventListener("change", function() {
            updateImageInput(select);
        });
    });

    // Hàm cập nhật trường input có name="image"
    function updateImageInput(select) {
        var row = select.closest('.template-row');
        var selectedOption = select.options[select.selectedIndex];
        var productInfo = row.querySelector('.productInfo');
        var productImageInput = productInfo.querySelector('input[name="image"]');

        // Lấy giá trị image từ data-image của lựa chọn
        var selectedImage = selectedOption.getAttribute("data-image");

        // Cập nhật giá trị của input[name="image"]
        productImageInput.value = selectedImage;
    }
</script>

<script>
    function addRow() {
        var table = document.querySelector('.table');
        var templateRow = document.querySelector('.template-row');
        var newRow = templateRow.cloneNode(true);
        newRow.id = '';
        var select = newRow.querySelector('select.product-select');
        var selectId = 'productSelect-' + new Date().getTime();
        select.id = selectId;
        var image = newRow.querySelector('img.product-image');
        var imageId = 'productImage-' + new Date().getTime();
        image.id = imageId;
        image.src = '';
        var quantityInput = newRow.querySelector('input.product-quantity');
        var quantityInputId = 'productQuantity-' + new Date().getTime();
        quantityInput.id = quantityInputId;
        quantityInput.value = '';
        var price = newRow.querySelector('td.product-price');
        var priceId = 'productPrice-' + new Date().getTime();
        price.id = priceId;
        price.textContent = '';
        var previousRow = table.querySelector('.current-row');
        if (previousRow) {
            previousRow.classList.remove('current-row');
        }
        newRow.classList.add('current-row');
        document.getElementById('productTableBody').appendChild(newRow);
        setupRow(newRow);
    }

    function setupRow(row) {
        var select = row.querySelector('select.product-select');
        var productInfo = row.querySelector('div.productInfo');
        var productImage = row.querySelector('img.product-image');
        var productPrice = row.querySelector('td.product-price');

        select.addEventListener("change", function() {
            var selectedOption = select.options[select.selectedIndex];

            if (selectedOption.value) {
                productInfo.style.display = "block";
                productImage.src = selectedOption.getAttribute("data-image");
                productPrice.textContent = selectedOption.getAttribute("data-price");
                updateTotal(row);
            } else {
                productInfo.style.display = "none";
            }
        });
    }

    var rows = document.querySelectorAll('.template-row');
    rows.forEach(function(row) {
        setupRow(row);
    });

    function updateTotal(row) {
        var quantityInput = row.querySelector('.product-quantity');
        var priceTd = row.querySelector('.product-price');
        var totalInput = row.querySelector('.product-total');

        var quantity = parseFloat(quantityInput.value);
        var price = parseFloat(priceTd.textContent.replace(/[^0-9.-]+/g, ''));

        var total = quantity * price;
        totalInput.value = total; // Giữ 2 chữ số thập phân
    }
</script>



<script>
    // Tạo một hàm để tính tổng giá trị
    function calculateTotal() {
        var total = 0;

        // Lặp qua tất cả các hàng sản phẩm
        $('.template-row').each(function() {
            var quantity = parseFloat($(this).find('.product-quantity').val()) || 0; // Số lượng
            var price = parseFloat($(this).find('.product-price').text().replace(/[^0-9.-]+/g, '')) || 0; // Giá của sản phẩm

            total += quantity * price; // Tính tổng giá trị
        });

        // Cập nhật giá trị tổng vào trường "Tổng tiền"
        $('#total').val(total);
    }

    $(document).ready(function() {
        // Gọi hàm calculateTotal khi trang web được tải và sau mỗi thay đổi số lượng hoặc giá
        calculateTotal();
        $('.product-quantity, .product-price').on('input', calculateTotal);
    });
</script>

<!-- image -->
<script>
    var selects = document.querySelectorAll('select.product-select');
    selects.forEach(function(select) {
        select.addEventListener("change", function() {
            updateImageInput(select);
        });
    });

    function updateImageInput(select) {
        var row = select.closest('.template-row');
        var selectedOption = select.options[select.selectedIndex];
        var productInfo = row.querySelector('.productInfo');
        var productImageInput = productInfo.querySelector('input[name="image[]"]');

        // Lấy giá trị image từ data-image của lựa chọn
        var selectedImage = selectedOption.getAttribute("data-image");

        // Trích xuất tên tệp từ đường dẫn
        var filename = selectedImage.split('/').pop(); // Lấy phần cuối cùng sau khi chia chuỗi dựa trên '/'

        // Cập nhật giá trị của input[name="image[]"] với tên tệp
        productImageInput.value = filename;
    }
</script>

</body>

</html>



</body>

</html>
@stop