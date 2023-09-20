@extends('admin.master')
@section('title', 'Cập nhật nhà quản trị')
@section('main')
<div class="container-fluid pt-4 px-4">
	<div class="row">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="bg-secondary text-center rounded p-4">
				<div class="align-items-center justify-content-between mb-4">
					<h6 class="mb-0" style="font-size: 24px;color: #EB1616;">CẬP NHẬT THÔNG TIN ADMIN</h6>
				</div>
				<div class="table-responsive">
					<table class="table text-start align-middle table-hover mb-0">
						<thead>
							<tr class="text-white" style="text-align: left;">
								<th scope="col">SỬA THÔNG TIN</th>
							</tr>
						</thead>
						<tbody>
							@include('errors.note')
							<form action="" method="post">
								<tr class="text-white" style="text-align: left;">
									<td>Tên nhà quản trị:</td>
								</tr>
								<tr class="text-white">
									<td><input style="background-color: white;" type="text" name="name" class="form-control" placeholder="Tên nhà quản trị..." value="{{Auth::user()->name}}"></td>
								</tr>
                                <tr class="text-white" style="text-align: left;">
									<td>Email nhà quản trị:</td>
								</tr>
								<tr class="text-white">
									<td><input style="background-color: white;" type="text" name="email" class="form-control" placeholder="Email nhà quản trị..." value="{{Auth::user()->email}}"></td>
								</tr>
                                <tr class="text-white" style="text-align: left;">
									<td>Mật khẩu: </td>
								</tr>
								<tr class="text-white">
									<td><input style="background-color: white;" type="text" name="password" class="form-control" placeholder="Mật khẩu..." value=""></td>
								</tr>
								<tr class="text-white">
									<td><button type="submit" name="submit" class="btn btn-primary py-2 w-100 mb-4">SỬA</button></td>
								</tr>
								<tr class="text-white">
									<td><a href="{{asset('admin/category')}}" class="btn btn-primary py-2 w-100 mb-4">HỦY BỎ</a></td>
								</tr>
								{{csrf_field()}}
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-3"></div>
	</div>

</div>

@stop