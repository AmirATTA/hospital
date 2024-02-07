@extends('layouts.admin.master')
@section('title', 'کاربر جدید')
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('insurances.store') }}" id="insurance" name="insurance" method="post" >
				@csrf
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">نام</label>
								<input class="form-control" value="{{ old('name') }}" placeholder="نام" name="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">نوع</label>
								<select class="form-control custom-select select2" name="type" data-placeholder="انتخاب نوع">
									<option label="انتخاب نوع"></option>
									<option value="basic">پایه</option>
									<option value="supplementary">تکمیلی</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">تخفیف</label>
								<input class="form-control-range" id="discount_input" type="range" name="discount" max="100" min="1" value="0" step="1">
								<span id="discount_label">0%</span>
							</div>
						</div>
					</div>
					<div class="custom-controls-stacked d-md-flex my-4">
						<label class="form-label mt-1 ml-5">وضعیت :</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="status" value="1" checked>
							<span class="custom-control-label">فعال</span>
						</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="status" value="0">
							<span class="custom-control-label">غیر فعال</span>
						</label>
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

	<script src="{{ asset('assets/js/form-elements.js') }}"></script>
@endsection