@extends('layouts.admin.master')
@section('title', 'عمل جراحی جدید')
@section('links')
	<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>

	<link href="{{ asset('assets/css/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet"/>

	<link href="{{ asset('assets/plugins/wysiwyag/rte_theme_default.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('surgeries.store') }}" id="surgery" name="surgery" method="post" >
				@csrf
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">نام و نام خانوادگی بیمار</label>
								<input class="form-control" value="{{ old('patient_name') }}" placeholder="نام" name="patient_name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">کدملی بیمار</label>
								<input class="form-control" value="{{ old('patient_national_code') }}" type="number" placeholder="نام" name="patient_national_code">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">شماره سند</label>
								<input class="form-control" value="{{ old('document_number') }}" type="number" placeholder="نام" name="document_number">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">بیمه</label>
								<select class="form-control custom-select select2" name="insurance" data-placeholder="انتخاب بیمه">
									<option label="انتخاب بیمه"></option>
									@foreach($insurances as $item)										
										<option value="{{ $item->id }}">
											{{ $item->name }} | @if($item->type == 'basic') پایه @else تکمیلی @endif
										</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6 tags-input">
							<div class="form-group required">
								<label class="form-label">عمل</label>
								<select class="form-control operations" multiple="multiple" name="operations[]">
									@foreach($operations as $item)										
										<option>{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label">توضیحات</label>
								<textarea class="content" name="description" id="example">{{ old('description') }}</textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">زمان جراحی</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="dp-surgeried">
											<span class="feather feather-calendar"></span>
										</div>
									</div><input class="form-control fc-datepicker hasDatepicker" value="{{ old('surgeried_at') }}" id="dp-surgeried-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
									<input type="hidden" value="{{ old('surgeried_at') }}" id="dp-surgeried-date" name="surgeried_at" aria-label="date11" aria-describedby="date11">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">زمان مرخصی</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="dp-released">
											<span class="feather feather-calendar"></span>
										</div>
									</div><input class="form-control fc-datepicker hasDatepicker" value="{{ old('released_at') }}" id="dp-released-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
									<input type="hidden" value="{{ old('released_at') }}" id="dp-released-date" name="released_at" aria-label="date11" aria-describedby="date11">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						@foreach($doctorRoles as $roles)
							<div class="col-md-6">
								<div class="form-group @if($roles->required == '1') required @endif">
									<label class="form-label">{{ $roles->title }}</label>

									<select class="form-control custom-select select2" 
									name="@if($roles->required == '1') doctorsInputRequired[] @else doctorsInput[] @endif" 
									data-placeholder="انتخاب {{ $roles->title }}">
									
										<option label="انتخاب {{ $roles->title }}"></option>
										@foreach($roles->doctors as $doctor)										
											<option value="{{ $doctor->id }}, {{ $roles->id }}">{{ $doctor->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
						@endforeach
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

	<script src="{{ asset('assets/plugins/jquery.md.bootstrap.datetimepicker.js') }}"></script>
	<script src="{{ asset('assets/js/calendar.js') }}"></script>
	
	<script src="{{ asset('assets/plugins/wysiwyag/rte.js') }}"></script>
	<script src="{{ asset('assets/plugins/wysiwyag/all_plugins.js') }}"></script>
	<script src="{{ asset('assets/js/form-editor2.js') }}"></script>

	<script src="{{ asset('assets/plugins/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection
