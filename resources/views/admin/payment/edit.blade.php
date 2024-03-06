@extends('layouts.admin.master')
@section('title', 'ویرایش توضیحات پرداختی')
@section('links')
	<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>

	<link href="{{ asset('assets/css/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet"/>

	<link href="{{ asset('assets/plugins/wysiwyag/rte_theme_default.css') }}" rel="stylesheet" />
	
	<!-- INTERNAL File Uploads css-->
	<link href="{{ asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">

		<x-errors></x-errors>
		
		<div class="card">
			<form action="{{ route('payments.update', $payment->id) }}" id="payment" name="payment" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')
				<div class="card-body">
					@php
						$invoice = App\Models\Invoice::select('id', 'amount')->where('id', $payment->invoice_id)->get()[0];
					@endphp
					<div class="d-flex" style="gap:20px;">
						<small class="form-text" style="color:green;">حداقل الزام پرداخت:	25,000 تومان</small>
						<small class="form-text" style="color:red;">حداکثر مبلغ قابل پرداخت:  {{ number_format($invoice->amount - $invoice->paymentSum() + $payment->amount) }} تومان</small>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">مبلغ</label>
								<input type="text" class="form-control amount" value="{{ number_format($payment->amount) }}" onkeyup="amountChange(this.value)" placeholder="مبلغ به تومان">
                                <input type="hidden" name="amount" value="{{ $payment->amount }}" id="amount">
                                <small>تومان</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required">
								<label class="form-label">نوع پرداخت</label>
								<select class="form-control custom-select select2" onchange="payTypeSelect(this)" name="pay_type" data-placeholder="انتخاب نوع پرداخت">
									<option label="انتخاب نوع پرداخت"></option>
									<option @selected($payment->pay_type == 'cash') value="cash">نقد</option>
									<option @selected($payment->pay_type == 'cheque') value="cheque">چک</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group required" id="due_date_input" @if($payment->due_date == null)style="display:none;"@endif>
								<label class="form-label">زمان سررسید</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="dp-due-date">
											<span class="feather feather-calendar"></span>
										</div>
									</div><input class="form-control fc-datepicker hasDatepicker" value="{{ $payment->due_date }}" id="dp-due-date-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
									<input type="hidden" value="{{ $payment->due_date }}" id="dp-due-date-date" name="due_date" aria-label="date11" aria-describedby="date11">
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">تصویر</label>
								<input type="file" class="dropify" id="image" data-height="180" name="receipt" accept=".jpg, .jpeg, .png" />
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label">توضیحات</label>
								<textarea class="content" name="description" id="example">{{ $payment->description }}</textarea>
							</div>
						</div>

						<input type="hidden" name="invoice_id" id="invoice_id" value="{{ $payment->invoice_id }}">
						<input type="hidden" name="payment_id" id="payment_id" value="{{ $payment->id }}">
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
	<script src="{{ asset('assets/plugins/jquery.md.bootstrap.datetimepicker.js') }}"></script>
	<script src="{{ asset('assets/js/calendar.js') }}"></script>

	<script src="{{ asset('assets/plugins/wysiwyag/rte.js') }}"></script>
	<script src="{{ asset('assets/plugins/wysiwyag/all_plugins.js') }}"></script>
	<script src="{{ asset('assets/js/form-editor2.js') }}"></script>

	<script src="{{ asset('assets/plugins/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/select2.js') }}"></script>
	
	<script src="{{ asset('assets/js/payment.js') }}"></script>
		
	<script src="{{ asset('assets/js/publishFormBtn.js') }}"></script>
	
	<!-- INTERNAL File uploads js -->
	<script src="{{ asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
	<script src="{{ asset('assets/js/filupload.js') }}"></script>
@endsection