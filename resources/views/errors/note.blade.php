<!-- Hiển thị bạn đã đăng ký thành công -->
@if(Session::has('success'))
    <p class='alert alert-success'>{{ Session::get('success') }}</p>
@endif

@if(Session::has('error'))
    <p class='alert alert-danger'>{{Session::get('error')}}</p>
@endif

<!-- Hiển thị thông báo lỗi -->
@foreach($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
@endforeach