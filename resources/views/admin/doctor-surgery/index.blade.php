@extends('layouts.admin.master')
@section('title', 'پرداخت پزشک')
@section('links')
	<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>

	<link href="{{ asset('assets/css/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet"/>

	<link href="{{ asset('assets/plugins/wysiwyag/rte_theme_default.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<form action="{{ route('doctor-surgeries.create') }}" id="doctor-surgery" name="doctor-surgery" method="post">
				@csrf
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">دكتر</label>
								<select class="form-control doctors" name="doctor">
									@foreach($doctors as $doctor)										

									@php
										$doctorSurgeries = App\Models\DoctorSurgery::where('doctor_id', $doctor->id)->whereNull('invoice_id')->count();
									@endphp

										<option value="{{ $doctor->id }}">{{ $doctor->name }} 
										({{ $doctorSurgeries }})</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">از تاريخ</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="dp-start">
											<span class="feather feather-calendar"></span>
										</div>
									</div><input class="form-control fc-datepicker hasDatepicker" value="{{ old('start_date') }}" id="dp-start-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
									<input type="hidden" value="{{ old('start_date') }}" id="dp-start-date" name="start_date" aria-label="date11" aria-describedby="date11">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">تا تاريخ</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="dp-end">
											<span class="feather feather-calendar"></span>
										</div>
									</div><input class="form-control fc-datepicker hasDatepicker" value="{{ old('end_date') }}" id="dp-end-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
									<input type="hidden" value="{{ old('end_date') }}" id="dp-end-date" name="end_date" aria-label="date11" aria-describedby="date11">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-left">
					<a onclick="window.history.back();" class="btn btn-danger btn-lg">برگشت</a>
					<button type="submit" class="btn btn-success btn-lg">جستجو</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/checkbox.js') }}"></script>

	<script src="{{ asset('assets/plugins/jquery.md.bootstrap.datetimepicker.js') }}"></script>
	<script src="{{ asset('assets/js/calendar.js') }}"></script>
	
	<script src="{{ asset('assets/plugins/wysiwyag/rte.js') }}"></script>
	<script src="{{ asset('assets/plugins/wysiwyag/all_plugins.js') }}"></script>
	<script src="{{ asset('assets/js/form-editor2.js') }}"></script>

	<script src="{{ asset('assets/plugins/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/select2.js') }}"></script>
	
	<script src="{{ asset('assets/js/publishFormBtn.js') }}"></script>
@endsection
