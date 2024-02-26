@extends('layouts.admin.master')
@section('title', 'ویرایش توضیحات صورت حساب')
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
			<form action="{{ route('invoices.update', $invoice->id) }}" id="invoice" name="invoice" method="post">
				@csrf
				@method('PATCH')
				<div class="card-body">
					<div class="col-12">
						<div class="form-group">
							<label class="form-label">توضیحات</label>
							<textarea class="content" name="description" id="example">{{ $invoice->description }}</textarea>
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
	<script src="{{ asset('assets/plugins/wysiwyag/rte.js') }}"></script>
	<script src="{{ asset('assets/plugins/wysiwyag/all_plugins.js') }}"></script>
	<script src="{{ asset('assets/js/form-editor2.js') }}"></script>

	<script src="{{ asset('assets/plugins/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/select2.js') }}"></script>
	
	<script src="{{ asset('assets/js/checkbox.js') }}"></script>

	<script src="{{ asset('assets/js/comma.js') }}"></script>
		
	<script src="{{ asset('assets/js/publishFormBtn.js') }}"></script>
@endsection