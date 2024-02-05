@extends('layouts.admin.master')
@section('title', 'ویرایش کاربر')
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('insurances.update', $insurance->id) }}" id="insurance" name="insurance" method="post">
				@csrf
				@method('PATCH')
				<div class="card-body">
				<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">نام</label>
								<input class="form-control" value="{{ $insurance->name }}" placeholder="نام" name="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">نوع</label>
								<select class="form-control custom-select select2" name="type" data-placeholder="انتخاب نوع">
									<option label="انتخاب نوع"></option>
									<option value="basic" @if($insurance->type == 'basic') selected @endif>پایه</option>
									<option value="supplementary" @if($insurance->type == 'supplementary') selected @endif>تکمیلی</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">تخفیف</label>
								<input class="form-control-range" id="discount_input" type="range" name="discount" max="100" min="0" value="{{ $insurance->discount }}" step="1">
								<span id="discount_label">0%</span>
							</div>
						</div>
					</div>
					<div class="custom-controls-stacked d-md-flex">
						<label class="form-label mt-1 ml-5">وضعیت :</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="status" value="1" @if($insurance->status == '1') checked @endif>
							<span class="custom-control-label">فعال</span>
						</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="status" value="0" @if($insurance->status == '0') checked @endif>
							<span class="custom-control-label">غیر فعال</span>
						</label>
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
	
	<script src="{{ asset('assets/js/form-elements.js') }}"></script>
@endsection