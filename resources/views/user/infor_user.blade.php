@extends('user.master')
@section('title', 'Trang chủ')
@section('css', 'css/index.css')
@section('main')
<!--------------------------------------------------------- Bắt đầu Thay ĐỔi ------------------------------------------------------------>
<!-- Dòng 2 -->
<form id="signupForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="">
    <div class="row">
        <!-- cột 1 -->
        <div class="col-3">
            <div class="container">
                <div style="text-align: center;">
                    <input name="image" type="file" id="fileInput" style="display: none;" accept="image/*">
                    <label for="fileInput" style="cursor: pointer;">
                        @if (empty($data['customerinfo']->image))
                        <img src="image/default_avatar.jpg" alt="Default Avatar" id="" style="width: 186px; border-radius: 20px; margin-top: 28px;">
                        @else
                        <img src="{{asset('storage/storage/avataruser/'.$data['customerinfo']->image)}}" alt="User Avatar" id="" style="width: 186px; border-radius: 20px; margin-top: 28px;height: 248px;">
                        @endif
                        <div style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -100%);background-color: rgba(0, 0, 0, 0.5); color: white; padding: 10px;">Cập nhật hình ảnh</div>
                    </label>
                </div>
                <div class="row" style="width: 100%;">
                    <div class="col-12">
                        <h5 style="text-align: center; margin: 20px 0;">{{$customer->name}}</h5>
                    </div>
                </div>
                <div class="row chitietcty">
                    <div class="col-2">
                        <i style="color: #EB1616;" class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="col-10 chitietctyhover">
                        <a href="{{asset('user/infor')}}" style="color: rgba(0, 0, 0, 0.72) !important; text-decoration: none">Thông tin cá
                            nhân</a>
                    </div>
                </div>
                <div class="row chitietcty">
                    <div class="col-2">
                        <i style="color: #EB1616;" class="fa fa-user-secret" aria-hidden="true"></i>
                    </div>
                    <div class="col-10 chitietctyhover">
                        <a href="user_doimatkhau.html" style="color: rgba(0, 0, 0, 0.72) !important; text-decoration: none;">Đổi mật
                            khẩu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- cột 2 -->
        <div class="col-9">
            <div class="row" style="margin-bottom: 20px;border-radius: 10px;padding: 20px;">
                <div class="col-12">
                    <h3>Thông tin cá nhân</h3>
                    <div style="width: 300px;" class="border-line-footer"></div>
                    @include('errors.note')
                    <!--  -->
                    <div class="col-12">
                        <div class="row form-group">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <label for="floatingInput">
                                        <i style="color: #EB1616;" class="fa fa-user" aria-hidden="true"></i>
                                        Họ và tên
                                    </label>
                                    <input name="name" type="name" class="form-control" id="floatingInput" placeholder="Họ và tên" autofocus="" value="{{$customer->name}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="floatingInput">
                                    <i style="color: #EB1616;" class="fa fa-phone" aria-hidden="true"></i>
                                    Số điện thoại
                                </label>
                                <div class="form-floating mb-3">
                                    <input name="phone" type="phone" class="form-control" id="floatingInput" placeholder="Số điện thoại" autofocus="" value="{{ isset($data['customerinfo']) ? $data['customerinfo']->phone : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="floatingInput">
                                    <i style="color: #EB1616;" class="fa fa-envelope" aria-hidden="true"></i>
                                    Email
                                </label>
                                <div class="form-floating mb-3">
                                    <!-- Email không thay đổi -->
                                    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="Email" autofocus="" value="{{$customer->email}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="floatingInput">
                                    <i style="color: #EB1616;" class="fa fa-home" aria-hidden="true"></i>
                                    Địa chỉ
                                </label>
                                <div class="form-floating mb-3">
                                    <input name="address" type="address" class="form-control" id="floatingInput" placeholder="Địa chỉ" autofocus="" value="{{ isset($data['customerinfo']) ? $data['customerinfo']->address : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="floatingInput">
                                    <i style="color: #EB1616;" class="fa fa-envelope" aria-hidden="true"></i>
                                    Tỉnh
                                </label>
                                <div class="form-floating mb-3">
                                    <select required name="tinh_id" id="tinh_id" class="js_location">
                                        <option value="">Vui lòng chọn tỉnh</option>
                                        @foreach($data['listtinh'] as $tinh)
                                        <option value="{{$tinh->tinh_id}}">{{$tinh->tinh_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="floatingInput">
                                    <i style="color: #EB1616;" class="fa fa-envelope" aria-hidden="true"></i>
                                    Huyện
                                </label>
                                <div class="form-floating mb-3">
                                    <select required name="huyen_id" id="huyen_id" class="js_location">
                                        <!-- Options for huyen will be loaded dynamically via Ajax -->
                                        <option value="">Vui lòng chọn huyện</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="floatingInput">
                                    <i style="color: #EB1616;" class="fa fa-home" aria-hidden="true"></i>
                                    Xã
                                </label>
                                <div class="form-floating mb-3">
                                    <select required name="xa_id" id="xa_id">
                                        <!-- Options for xa will be loaded dynamically via Ajax -->
                                        <option value="">Vui lòng chọn xã</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row form-group">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <input name="submit" value="Lưu" type="submit" class="btn btn-primary"></input>
                                        <a href="#" class="btn btn-primary">Hủy bỏ</a>
                                    </div>
                                    <div class="col-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                     
                     -->
                </div>
            </div>
        </div>
    </div>
    {{csrf_field()}}
</form>
<!--------------------------------------------------------- Kết Thúc Thay ĐỔi ------------------------------------------------------------>
@stop
@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Xử lý sự kiện khi tỉnh thay đổi
        $('#tinh_id').change(function() {
            var tinhId = $(this).val();

            // Gọi Ajax để lấy danh sách huyện dựa trên tỉnh đã chọn
            $.get('http://127.0.0.1:8000/user/infor/{id}/huyen', {
                tinh_id: tinhId
            }, function(data) {
                $('#huyen_id').empty();
                $('#xa_id').empty();
                $('#huyen_id').append('<option value="">Vui lòng chọn huyện</option>');
                $('#xa_id').append('<option value="">Vui lòng chọn xã</option>');

                $.each(data, function(index, huyen) {
                    $('#huyen_id').append('<option value="' + huyen.huyen_id + '">' + huyen.huyen_name + '</option>');
                });
            });
        });

        // Xử lý sự kiện khi huyện thay đổi
        $('#huyen_id').change(function() {
            var huyenId = $(this).val();

            // Gọi Ajax để lấy danh sách xã dựa trên huyện đã chọn
            $.get('http://127.0.0.1:8000/user/infor/{id}/xa', {
                huyen_id: huyenId
            }, function(data) {
                $('#xa_id').empty();
                $('#xa_id').append('<option value="">Vui lòng chọn xã</option>');

                $.each(data, function(index, xa) {
                    $('#xa_id').append('<option value="' + xa.xa_id + '">' + xa.xa_name + '</option>');
                });
            });
        });
    });
</script>

</body>

</html>
@stop