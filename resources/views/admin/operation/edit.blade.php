@extends('layouts.admin.master')
@section('title', 'ویرایش عمل')
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('operations.update', $operation->id) }}" id="Speciality" name="Speciality" method="post">
				@csrf
				@method('PATCH')
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">عنوان</label>
								<input class="form-control" value="{{ $operation->name }}" placeholder="عنوان" name="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">قیمت</label>
								<div style="display: flex;gap:10px;">
									<input class="form-control comma" value="{{ $operation->price }}" placeholder="قیمت" name="price">
									<span> تومان</span>
								</div>
							</div>
						</div>
					</div>
					<div class="custom-controls-stacked d-md-flex">
						<label class="form-label mt-1 ml-5">وضعیت :</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="status" value="1" @if($operation->status == '1') checked @endif>
							<span class="custom-control-label">فعال</span>
						</label>
						<label class="custom-control custom-radio success ml-4">
							<input type="radio" class="custom-control-input" name="status" value="0" @if($operation->status == '0') checked @endif>
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

	<script src="{{ asset('assets/js/comma.js') }}"></script>
		
	<script src="{{ asset('assets/js/publishFormBtn.js') }}"></script>
@endsection