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
                        <a href="{{asset('user/infor/'.$customer->id)}}" style="color: rgba(0, 0, 0, 0.72) !important; text-decoration: none">Thông tin cá
                            nhân</a>
                    </div>
                </div>
                <div class="row chitietcty">
                    <div class="col-2">
                        <i style="color: #EB1616;" class="fa fa-user-secret" aria-hidden="true"></i>
                    </div>
                    <div class="col-10 chitietctyhover">
                        <a href="{{asset('user/infor/reset-pass/'.$customer->id)}}" style="color: rgba(0, 0, 0, 0.72) !important; text-decoration: none;">Đổi mật
                            khẩu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- cột 2 -->
        <div class="col-9">
            <div class="row" style="margin-bottom: 20px;border-radius: 10px;padding: 20px;">
                <div class="col-12">
                    <h3>Thay đổi mật khẩu</h3>
                    <div style="width: 300px;" class="border-line-footer"></div>
                    @include('errors.note')
                    <!--  -->
                    <div class="col-12">
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="old_password">
                                    <i style="color: #EB1616;" class="fa fa-envelope" aria-hidden="true"></i>
                                    Mật khẩu cũ
                                </label>
                                <div class="form-floating mb-3">
                                    <input name="old_password" type="password" class="form-control" id="old_password" placeholder="Mật khẩu cũ" autofocus="">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="new_password">
                                    <i style="color: #EB1616;" class="fa fa-envelope" aria-hidden="true"></i>
                                    Mật khẩu mới
                                </label>
                                <div class="form-floating mb-3">
                                    <input name="new_password" type="password" class="form-control" id="new_password" placeholder="Nhập mật khẩu mới" autofocus="">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="confirm_password">
                                    <i style="color: #EB1616;" class="fa fa-envelope" aria-hidden="true"></i>
                                    Nhập lại mật khẩu mới
                                </label>
                                <div class="form-floating mb-3">
                                    <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Nhập lại mật khẩu mới" autofocus="">
                                </div>
                                <div id="password_mismatch_error" style="color: red;"></div>
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
<script>
    // Lấy tham chiếu đến các trường mật khẩu trong DOM
    const passwordField = document.getElementById('new_password');
    const confirmPasswordField = document.getElementById('confirm_password');
    const passwordMismatchError = document.getElementById('password_mismatch_error');

    // Thêm sự kiện kiểm tra khi một trong hai trường mật khẩu thay đổi
    passwordField.addEventListener('input', checkPasswordMatch);
    confirmPasswordField.addEventListener('input', checkPasswordMatch);

    // Hàm kiểm tra khớp giữa hai trường mật khẩu
    function checkPasswordMatch() {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;

        if (password === confirmPassword) {
            // Hai trường mật khẩu giống nhau, không có lỗi
            confirmPasswordField.setCustomValidity('');
            passwordMismatchError.textContent = ''; // Xóa thông báo lỗi nếu có
        } else {
            // Hai trường mật khẩu không giống nhau, đặt lỗi
            confirmPasswordField.setCustomValidity('Mật khẩu không khớp');

            // Hiển thị thông báo lỗi
            passwordMismatchError.textContent = 'Mật khẩu không khớp';
        }
    }
</script>


</body>

</html>
@stop