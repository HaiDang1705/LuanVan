@extends('admin.master')
@section('title', 'Thêm đơn nhập hàng')
@section('main')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="font-size: 24px;margin: auto; color: #EB1616;">THÊM ĐƠN NHẬP HÀNG</h6>
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
                                <input required name="madon" style=" text-align: left !important;" type="text" class="form-control" placeholder="Nhập mã đơn nhập hàng">
                            </div>
                        </div>

                        <div class="form-group row" style=" text-align: left !important;">
                            <div class="col-sm-6">
                                <label for="">Người nhập đơn<span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input required name="name" type="text" class="form-control" placeholder="Tên người nhập">
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
                                <textarea required name="description" id="" cols="70" rows="10" placeholder="Nội dung đơn"></textarea>
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

                                    <div class="col-sm-6" style=" text-align: right !important;">
                                        <a href="{{asset('admin/thuonghieu')}}" class="btn btn-sm btn-primary">Thêm Nhà Cung Cấp</a>
                                        <button onclick="addRow()" type="button" class="btn btn-sm btn-primary" id="addProductRow">Thêm Sản Phẩm</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="" style="margin-bottom: 10px;">
                                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr class="text-white">
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Nhà cung cấp</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá nhập</th>
                                                <th scope="col">THÀNH TIỀN</th>
                                                <th scope="col">THAO TÁC</th>
                                            </tr>
                                        </thead>

                                        <!-- <tbody id="productTableBody">
                                            <tr class="text-white template-row" id="template-row">
                                                <td>
                                                    <select required name="product_name" class="product-select">
                                                        <option value="" selected>Chọn sản phẩm</option>
                                                        @foreach($listproduct as $product)
                                                        <option value="{{$product->product_id}}" data-image="{{ asset('storage/storage/avatar/' . $product->product_image) }}" data-price="{{ $product->product_price }}">{{$product->product_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="productInfo">
                                                        <img class="product-image" width="100px" src="" alt="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input required type="number" class="product-quantity" name="" id="" value="{{$product->product_quantity}}" placeholder="Số lượng sản phẩm">
                                                </td>
                                                <td class="product-price">

                                                    

                                                </td>
                                                <td>
                                                    {{number_format($product->product_price * $product->product_quantity )}}
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" href="" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                                                </td>
                                            </tr>
                                        </tbody> -->
                                        <tbody id="productTableBody">

                                            <tr class="text-white template-row" id="productRow-{{$product->product_id}}">
                                                <td>
                                                    <select required name="product_name[]" class="product-select" data-product-id="{{$product->product_id}}">
                                                        <option value="" selected>Chọn sản phẩm</option>
                                                        @foreach($listproduct as $product)
                                                        <option value="{{$product->product_id}}" data-image="{{ asset('storage/storage/avatar/' . $product->product_image) }}" data-price="{{ $product->product_price }}">{{$product->product_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select required name="product_brand[]" class="product-select" data-product-id="">
                                                        <option value="" selected>Chọn nhà cung cấp</option>
                                                        @foreach($listbrand as $brand)
                                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="productInfo">
                                                        <img class="product-image" width="70px" src="" alt="">
                                                        <input style="display: none;" type="text" name="image[]" placeholder="Ảnh sản phẩm">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input required type="number" name="quantity[]" class="product-quantity" name="" id="" value="" placeholder="Số lượng sản phẩm">
                                                </td>
                                                <!-- <td class="product-price"></td> -->
                                                <td>
                                                    <input name="price_nhap[]" required type="number" class="product-price" value="">
                                                </td>
                                                <td>
                                                    <input name="price[]" required type="number" class="product-total" readonly>
                                                </td>
                                                <td>
                                                    <button onclick="deleteRow(event)" type="button" class="btn btn-sm btn-primary" id="addProductRow">Xóa</button>
                                                    <!-- <a class="btn btn-sm btn-primary" style="margin-bottom: 10px;" href="{{asset('admin/nhap/delete/'.$product->product_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a> -->
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="total" style="color: red;">Tổng tiền</label>
                                    <input required name="total" id="total" type="number" value="" class="form-control" placeholder="Tổng tiền">
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>

                        <div class="row">
                            <div class="">
                                <input name="submit" type="submit" class="btn btn-primary" value="Thêm"></input>
                                <a href="{{asset('admin/nhap')}}" class="btn btn-primary">Hủy bỏ</a>
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



<script>
    function deleteRow(event) {
        var button = event ? event.currentTarget : null;
        if (!button) {
            // Nếu event không được cung cấp, xử lý nó tùy theo nhu cầu (nếu cần)
            console.error("Không cung cấp event");
            return;
        }
        var row = button.closest('tr');

        // Kiểm tra xem có phải là dòng cuối cùng không
        var rowCount = document.querySelectorAll('#productTableBody tr').length;
        if (rowCount > 1) {
            row.remove();
        } else {
            // Nếu chỉ còn một dòng, hãy xóa giá trị các trường input
            var inputs = row.querySelectorAll('input');
            inputs.forEach(function(input) {
                input.value = '';
            });

            // Thêm mã để xóa giá trị src của hình ảnh
            var productImage = row.querySelector('img.product-image');
            productImage.src = '';

            // Cập nhật giá trị của input name="image[]" cho hàng
            var selectedOption = row.querySelector('select[name="product_name[]"]').options[0];
            var imageInput = row.querySelector('input[name="image[]"]');
            imageInput.value = selectedOption ? selectedOption.getAttribute("data-image") : '';

            // Cập nhật giá trị của input name="product_brand[]" cho hàng
            var brandSelect = row.querySelector('select[name="product_brand[]"]');
            brandSelect.value = '';

            // Nếu bạn muốn xóa giá trị của các trường khác, thêm mã tương ứng ở đây
        }

        event.stopPropagation();
    }

    // Gắn sự kiện "click" cho nút xóa trong mỗi hàng
    var deleteButtons = document.querySelectorAll('.table tbody tr button.btn-primary');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', deleteRow);
    });

    function addRow() {
        var table = document.querySelector('.table');
        var templateRow = document.querySelector('.template-row');
        var newRow = templateRow.cloneNode(true);
        newRow.id = '';

        // Cần xóa giá trị của các trường input trong dòng mới
        var inputs = newRow.querySelectorAll('input');
        inputs.forEach(function(input) {
            input.value = '';
        });

        // Update select element IDs
        var selectProduct = newRow.querySelector('select[name="product_name[]"]');
        selectProduct.id = 'productSelect-' + new Date().getTime();

        var selectBrand = newRow.querySelector('select[name="product_brand[]"]');
        selectBrand.id = 'productBrand-' + new Date().getTime();

        var totalInput = newRow.querySelector('.product-total');
        totalInput.id = 'productTotal-' + new Date().getTime();

        // Other updates (e.g., image, quantity, etc.) go here

        var previousRow = table.querySelector('.current-row');
        if (previousRow) {
            previousRow.classList.remove('current-row');
        }

        // Thêm dòng sau để xóa giá trị src của hình ảnh
        var productImage = newRow.querySelector('img.product-image');
        productImage.src = '';

        // Cập nhật giá trị của input name="image[]" cho hàng mới
        var selectedOption = selectProduct.options[selectProduct.selectedIndex];
        var imageInput = newRow.querySelector('input[name="image[]"]');
        imageInput.value = selectedOption.getAttribute("data-image");

        newRow.classList.add('current-row');
        document.getElementById('productTableBody').appendChild(newRow);
        setupRow(newRow);

        // Gắn sự kiện "change" cho các phần tử select trong dòng mới
        var selects = newRow.querySelectorAll('select.product-select');
        selects.forEach(function(select) {
            select.addEventListener("change", function() {
                updateImageInput(select);
            });
        });
    }


    function setupRow(row) {
        var select = row.querySelector('select.product-select');
        var productInfo = row.querySelector('div.productInfo');
        var productImage = row.querySelector('img.product-image');
        var productPrice = row.querySelector('td.product-price');
        var totalInput = row.querySelector('.product-total');
        var imageInput = row.querySelector('input[name="image[]"]'); // Thêm dòng này

        select.addEventListener("change", function() {
            var selectedOption = select.options[select.selectedIndex];

            if (selectedOption.value) {
                productInfo.style.display = "block";
                productImage.src = selectedOption.getAttribute("data-image");
                productPrice.textContent = selectedOption.getAttribute("data-price");

                // Cập nhật giá trị của input
                imageInput.value = selectedOption.getAttribute("data-image");

                calculateTotalForRow(row);
            } else {
                productInfo.style.display = "none";
                // Xóa giá trị của input nếu không có sản phẩm được chọn
                imageInput.value = '';
            }
        });

        // Lắng nghe sự kiện khi số lượng hoặc giá thay đổi
        var quantityInput = row.querySelector('.product-quantity');
        var priceInput = row.querySelector('.product-price');

        quantityInput.addEventListener('input', function() {
            calculateTotalForRow(row);
        });

        priceInput.addEventListener('input', function() {
            calculateTotalForRow(row);
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
    // Lắng nghe sự kiện khi số lượng hoặc đơn giá thay đổi
    var productRows = document.querySelectorAll('.template-row');

    productRows.forEach(function(row) {
        var quantityInput = row.querySelector('.product-quantity');
        var priceInput = row.querySelector('.product-price');
        var totalInput = row.querySelector('.product-total');

        quantityInput.addEventListener('input', updateTotal);
        priceInput.addEventListener('input', updateTotal);

        // Khởi tạo tổng giá trị ban đầu
        updateTotal();

        function updateTotal() {
            var quantity = parseFloat(quantityInput.value);
            var price = parseFloat(priceInput.value);

            var total = quantity * price;
            totalInput.value = total; // Giữ 2 chữ số thập phân
        }
    });

    function calculateTotalForRow(row) {
        var quantityInput = row.querySelector('.product-quantity');
        var priceInput = row.querySelector('.product-price');
        var totalInput = row.querySelector('.product-total');

        var quantity = parseFloat(quantityInput.value) || 0; // Số lượng
        var price = parseFloat(priceInput.value) || 0; // Giá của sản phẩm

        var total = quantity * price;
        totalInput.value = total; // Hiển thị tổng với 2 chữ số thập phân
    }
</script>



<script>
    // Tạo một hàm để tính tổng giá trị
    function calculateTotal() {
        var total = 0;

        // Lặp qua tất cả các hàng sản phẩm
        $('.template-row').each(function() {
            var row = $(this);
            var quantity = parseFloat(row.find('.product-quantity').val()) || 0; // Số lượng
            var price = parseFloat(row.find('.product-price').val()) || 0; // Giá của sản phẩm

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