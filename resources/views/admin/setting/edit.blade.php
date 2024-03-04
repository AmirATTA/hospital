@extends('layouts.admin.master')
@section('title', "ویرایش تنظیمات - تنظیمات $title")
@section('links')
	<!-- INTERNAL File Uploads css-->
	<link href="{{ asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('settings.update') }}" id="setting" name="setting" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')
				<div class="card-body">
					<div class="row">
						@foreach($settingTypes as $type => $settings)
							@if($type == 'text' || $type == 'number' || $type == 'email')
								@foreach($settings as $setting)
									<div class="col-md-4">
										<div class="form-group">
											<label class="form-label">{{ $setting->label }}</label>
											<input type="{{ $setting->type }}" value="{{ $setting->value }}" 
											placeholder="{{ $setting->label }}" id="{{ $setting->name }}" 
											name="{{ $setting->name }}" 
											@if($type == 'number') min="0" @endif class="form-control">
										</div>
									</div>
								@endforeach
							@endif
							@if($type == 'image')
								@foreach($settings as $setting)
									<div class="col-md-4">
										<div class="form-group">
											<label class="form-label">{{ $setting->label }}</label>
                                            <input type="file" class="dropify" id="image" data-height="180" name="{{ $setting->name }}" accept=".jpg, .jpeg, .png" />
										</div>
									</div>
								@endforeach
							@endif
						@endforeach
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
	<script src="{{ asset('assets/js/publishFormBtn.js') }}"></script>

	<!-- INTERNAL File uploads js -->
	<script src="{{ asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
	<script src="{{ asset('assets/js/filupload.js') }}"></script>
@endsection
