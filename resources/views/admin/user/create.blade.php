@extends('layouts.admin.master')
@section('title', 'کاربر جدید')
@section('links')
	<!-- INTERNAL Data table css -->
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min-rtl.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datatable/css/rowGroup.bootstrap4.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('users.store') }}" id="user" name="user" method="post" >
				@csrf
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">نام و نام خانوادگی</label>
								<input class="form-control" value="{{ old('name') }}" placeholder="عنوان" name="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">شماره موبایل</label>
								<input class="form-control" value="{{ old('mobile') }}" type="number" placeholder="شماره موبایل" name="mobile">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">ایمیل</label>
								<input class="form-control" value="{{ old('email') }}" type="email" placeholder="ایمیل" name="email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">کلمه عبور</label>
								<input class="form-control" type="password" placeholder="کلمه عبور" name="password">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">تکرار کلمه عبور</label>
								<input class="form-control" type="password" placeholder="تکرار کلمه عبور" name="password_confirmation">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive role-table">
										<table class="table table-vcenter text-nowrap table-bordered border-bottom" id="superrole-list">
											<thead>
												<tr>
													<th class="border-bottom-0 w-5 text-center">ردیف</th>
													<th class="border-bottom-0">مقام</th>
													<th class="border-bottom-0">Dashboard</th>
													<th class="border-bottom-0 text-center">بازدید</th>
													<th class="border-bottom-0 text-center">ساخت</th>
													<th class="border-bottom-0 text-center">بروزرسانی</th>
													<th class="border-bottom-0 text-center">حذف</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="text-center">1</td>
													<td>مدیر</td>
													<td>1. مدیریت کابران</td>
													@foreach($permissions[0] as $permission)
														<td class="text-center">
															<a href="#" data-id="{{ $permission }}" data-statue="0" onclick="addPermission(event, this)" class="access-icon role">
																<span class="feather feather-x text-danger icon-style-circle bg-danger-transparent"></span>
															</a>
														</td>
													@endforeach
												</tr>

												<tr>
													<td class="text-center">2</td>
													<td>دکتر</td>
													<td>2. مدیریت دکتر ها</td>
													@foreach($permissions[1] as $permission)
														<td class="text-center">
															<a href="#" data-id="{{ $permission }}" data-statue="0" onclick="addPermission(event, this)" class="access-icon role">
																<span class="feather feather-x text-danger icon-style-circle bg-danger-transparent"></span>
															</a>
														</td>
													@endforeach
												</tr>

												<tr>
													<td class="text-center">3</td>
													<td>مدیر</td>
													<td>3. نقش دکتر ها</td>
													@foreach($permissions[2] as $permission)
														<td class="text-center">
															<a href="#" data-id="{{ $permission }}" data-statue="0" onclick="addPermission(event, this)" class="access-icon role">
																<span class="feather feather-x text-danger icon-style-circle bg-danger-transparent"></span>
															</a>
														</td>
													@endforeach
												</tr>

												<tr>
													<td class="text-center">4</td>
													<td>مدیر</td>
													<td>4. تخصص ها</td>
													@foreach($permissions[3] as $permission)
														<td class="text-center">
															<a href="#" data-id="{{ $permission }}" data-statue="0" onclick="addPermission(event, this)" class="access-icon role">
																<span class="feather feather-x text-danger icon-style-circle bg-danger-transparent"></span>
															</a>
														</td>
													@endforeach
												</tr>

												<tr>
													<td class="text-center">5</td>
													<td>مدیر</td>
													<td>5. عمل ها</td>
													@foreach($permissions[4] as $permission)
														<td class="text-center">
															<a href="#" data-id="{{ $permission }}" data-statue="0" onclick="addPermission(event, this)" class="access-icon role">
																<span class="feather feather-x text-danger icon-style-circle bg-danger-transparent"></span>
															</a>
														</td>
													@endforeach
												</tr>

												<tr>
													<td class="text-center">6</td>
													<td>مدیر</td>
													<td>6. بیمه ها</td>
													@foreach($permissions[5] as $permission)
														<td class="text-center">
															<a href="#" data-id="{{ $permission }}" data-statue="0" onclick="addPermission(event, this)" class="access-icon role">
																<span class="feather feather-x text-danger icon-style-circle bg-danger-transparent"></span>
															</a>
														</td>
													@endforeach
												</tr>
											</tbody>
										</table>

										<input type="hidden" value="{{ old('permission_ids') }}" name="permission_ids" id="permission_ids">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-left">
					<a onclick="window.history.back();" class="btn btn-danger btn-lg">برگشت</a>
					<button type="submit" class="btn btn-success btn-lg">ثبت</button>
				</div>
			</form>
		</div>
	</div>
</div>


















<!--Row-->
<div class="row">
	
</div>
<!-- End Row-->
<!-- End Row -->
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/checkbox.js') }}"></script>

	<!-- INTERNAL Data tables -->
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.rowGroup.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>

	<!-- INTERNAL Index js-->
	<script src="{{ asset('assets/js/superadmin/superadmin-role.js') }}"></script>
@endsection

<!-- <a href="#" class="access-icon role"><span class="feather feather-check text-success icon-style-circle bg-success-transparent"></span></a> -->