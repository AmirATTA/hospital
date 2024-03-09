@extends('layouts.admin.master')
@section('title', 'کاربر جدید')
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
													<th class="border-bottom-0">مام</th>
													<th class="border-bottom-0 text-center">بازدید</th>
													<th class="border-bottom-0 text-center">ساخت</th>
													<th class="border-bottom-0 text-center">بروزرسانی</th>
													<th class="border-bottom-0 text-center">حذف</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($permissions as $permissionChunk)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        @php 
                                                            $permTitle = $admin->permissions->where('id', head($permissionChunk))->pluck('label')[0]; 
                                                            $title = explode(' ', $permTitle)
                                                        @endphp
                                                        <td>{{ $loop->iteration }}. {{ implode(' ', array_slice($title, 1)) }}</td>
                                                        @foreach($permissionChunk as $permission)
                                                            <td class="text-center">
                                                                <a href="#" data-id="{{ $permission }}" data-statue="0" onclick="addPermission(event, this)" class="access-icon role">
                                                                    <span class="feather feather-x text-danger icon-style-circle bg-danger-transparent"></span>
                                                                </a>
                                                            </td>
                                                        @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
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
<!-- End Row -->
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/checkbox.js') }}"></script>

	<!-- INTERNAL Index js-->
	<script src="{{ asset('assets/js/superadmin/superadmin-role.js') }}"></script>
	
	<script src="{{ asset('assets/js/publishFormBtn.js') }}"></script>
@endsection