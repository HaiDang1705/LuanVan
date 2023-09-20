@extends('user.master')
@section('title', 'Đăng nhập')
@section('css', 'css/dangnhap.css')
@section('main')
<!---------------------------------------------------- LOGIN START --------------------------------------------------------->
<main role="main">
    <div class="container mt-4 logincart">
        <h1 class="text-center">Đăng Nhập</h1>
        <div class="row" style="text-align:center">
            <div class="col col-md-12">
                @include('errors.note')
                <form role="form" method="post">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" name="email" value="{{old('email')}}" id="floatingInput" placeholder="Tên tài khoản" class="form-control" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" value="" id="floatingPassword" placeholder="Mật khẩu" class="form-control" />
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                <label class="form-check-label" for="form2Example31"> Remember me </label>
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                            <a href="#!">Bạn quên mật khẩu?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button id="button-signin" type="submit" style="border: none;" class="btn btn-primary btn-block mb-4">Đăng nhập</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Bạn không có tài khoản ? <a href="{{asset('user/register')}}">Đăng ký</a></p>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
</main>
<!---------------------------------------------------- LOGIN END --------------------------------------------------------->
@stop
@section('script')

</body>

</html>
@stop