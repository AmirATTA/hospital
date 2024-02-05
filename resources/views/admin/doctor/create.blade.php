@extends('layouts.admin.master')
@section('title', 'کاربر جدید')
@section('links')
	<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('doctors.store') }}" id="Doctor" name="Doctor" method="post" >
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
								<label class="form-label">تخصص</label>
								<select class="form-control custom-select select2" name="speciality_id" data-placeholder="انتخاب تخصص">
									<option label="انتخاب نوع تخصص"></option>
									@foreach($specialities as $item)										
										<option value="{{ $item->id }}">{{ $item->title }}</option>
									@endforeach
								</select>
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
											<input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $id }}">
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

	<script src="{{ asset('assets/plugins/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection