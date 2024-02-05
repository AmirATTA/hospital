@extends('layouts.admin.master')
@section('title', 'ویرایش کاربر')
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('users.update', $user->id) }}" id="user" name="user" method="post">
				@csrf
				@method('PATCH')
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">نام و نام خانوادگی</label>
								<input class="form-control" value="{{ $user->name }}" placeholder="عنوان" name="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">شماره موبایل</label>
								<input class="form-control" value="{{ $user->mobile }}" type="number" placeholder="شماره موبایل" name="mobile">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">ایمیل</label>
								<input class="form-control" value="{{ $user->email }}" type="email" placeholder="ایمیل" name="email">
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
							<div class="form-group m-0">
								<label class="form-label">مجوز ها</label>
								<div class="custom-controls-stacked">
									@foreach($permissions as $id => $label)
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $id }}" 
											@if (in_array($id, $userPermissions)) checked @endif>
											<span class="custom-control-label">{{ $label }}</span>
										</label>
									@endforeach
								</div>
								<label class="custom-control custom-checkbox select-all">
									<input type="checkbox" class="custom-control-input" id="select_all">
									<span class="custom-control-label">انتخاب همه</span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-left">
					<a onclick="window.history.back();" class="btn btn-danger btn-lg">برگشت</a>
					<button type="submit" class="btn btn-success btn-lg">بروزرسانی</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/checkbox.js') }}"></script>
@endsection