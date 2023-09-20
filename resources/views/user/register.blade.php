@extends('user.master')
@section('title', 'Đăng ký')
@section('css', 'css/dangky.css')
@section('main')
<!---------------------------------------------------- REGISTER START --------------------------------------------------------->
<div class="row" style="margin: 20px 0;">
    <div class="col-sm-8 offset-sm-2">
        <div class="card card-signup">
            <div class="card-header">
                <h3>Đăng ký tài khoản</h3>
            </div>
            <div class="card-body">
                @include('errors.note')
                <form id="signupForm" method="post" enctype="multipart/form-data" class="form-horizontal" action="">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="email">Email</label>
                        <div class="col-sm-5">
                            <input required type="text" name="email" class="form-control" id="email" placeholder="Email của bạn">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="name">Họ và tên</label>
                        <div class="col-sm-5">
                            <input required type="text" name="name" class="form-control" id="name" placeholder="Tên của bạn">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="address">Địa chỉ</label>
                        <div class="col-sm-5">
                            <input required type="text" name="address" class="form-control" id="address" placeholder="Địa chỉ">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="phone">Số điện thoại</label>
                        <div class="col-sm-5">
                            <input required type="text" name="phone" class="form-control" id="phone" placeholder="Số điện thoại">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="password">Mật khẩu</label>
                        <div class="col-sm-5">
                            <input required type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="password_confirmation">Nhập lại mật khẩu</label>
                        <div class="col-sm-5">
                            <input required type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>

                    <!-- <div class="form-group form-check">
                        <div class="col-sm-5 offset-sm-4">
                            <input class="form-check-input" type="checkbox" id="agree" name="agree" value="agree">
                            <label class="form-check-lable" for="agree">Đồng ý các quy định của chúng tôi</label>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-sm-5 offset-sm-4">
                            <input type="submit" name="submit" class="btn btn-primary" value="Đăng ký"></input>
                            <a href="{{asset('user/login')}}" class="btn btn-primary">Hủy bỏ</a>
                        </div>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------------------- REGISTER FINISH --------------------------------------------------------->
@stop
@section('script')
<!--  -->

</body>

</html>
@stop