@extends('layouts.admin.master')
@section('title', 'ویرایش نقش')
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('doctor-roles.update', $doctorRole->id) }}" id="Doctor-role" name="Doctor-role" method="post">
				@csrf
				@method('PATCH')
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">عنوان</label>
								<input class="form-control" value="{{ $doctorRole->title }}" placeholder="عنوان" name="title">
							</div>
						</div>
					</div>
					<div class="custom-controls-stacked d-md-flex">
						<label class="form-label mt-1 ml-5">وضعیت :</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="required" value="1" @if($doctorRole->required == '1') checked @endif>
							<span class="custom-control-label">ضرور</span>
						</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="required" value="0" @if($doctorRole->required == '0') checked @endif>
							<span class="custom-control-label">غیر ضرور</span>
						</label>
					</div>
					<div class="custom-controls-stacked d-md-flex">
						<label class="form-label mt-1 ml-5">وضعیت :</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="status" value="1" @if($doctorRole->status == '1') checked @endif>
							<span class="custom-control-label">فعال</span>
						</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="status" value="0" @if($doctorRole->status == '0') checked @endif>
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
@endsection