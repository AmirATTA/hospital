@extends('layouts.admin.master')
@section('title', 'صورت حساب ها')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
	
	<link href="{{ asset('assets/css/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet"/>

	<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
	
	<!-- INTERNAL File Uploads css-->
	<link href="{{ asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Row -->
@can('view operations')
<div class="row">
	<div class="col-md-12">
		<div class="card">

            <!-- Search & filter -->
            <form action="{{ route('invoices.search') }}" method="GET">
                <div class="form-group mt-5 d-flex" 
                style="margin:10px 25px;align-items: center;justify-content: space-between;flex-wrap: wrap;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">دکتر</label>
                            <select class="form-control custom-select select2" name="id" data-placeholder="انتخاب دکتر">
                                <option label="انتخاب دکتر"></option>
                                @foreach($invoicesSearch as $invoice)			
                                
                                    @php $doctorName = App\Models\Doctor::where('id', $invoice->doctor_id)->select('name')->get(); @endphp
                                
                                    <option value="{{ $invoice->id }}" @selected(isset($search['id']) && $invoice->id == $search['id'])>{{ $doctorName[0]['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">وضعیت</label>
                            <select class="form-control custom-select select2" name="status" data-placeholder="انتخاب وضعیت">
                                <option label="انتخاب وضعیت"></option>
                                <option value="true" @selected(isset($search['status']) && 'true' == $search['status'])>پرداخت شده</option>
                                <option value="false" @selected(isset($search['status']) && 'false' == $search['status'])>پرداخت نشده</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-left" style="width: 100%;">
                        <button type="submit" class="btn btn-primary btn-block">جستجو</button>
                        @if(isset($search))
                            <button id="resetFiltersButton" type="button" class="btn btn-warning btn-block">پاک کردن فیلتر ها</button>
                            <script>
                                document.getElementById('resetFiltersButton').addEventListener('click', function() {
                                    var currentUrl = window.location.href;
                                    var baseUrl = currentUrl.split('/search')[0];
                                    window.location.href = baseUrl;
                                });
                            </script>
                        @endif
                    </div>
                </div>
            </form>
            <!-- End Search & filter -->

			<div class="card-body">
				<div class="table-responsive">
					<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
						<thead>
							<tr>
								<th class="border-bottom-0">ردیف</th>
								<th class="border-bottom-0">نام دکتر</th>
								<th class="border-bottom-0">قیمت کل (به تومان)</th>
								<th class="border-bottom-0">توضیحات</th>
								<th class="border-bottom-0">وضعیت</th>
								<th class="border-bottom-0">اقدامات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($invoices as $data)

								@php
									$doctor = App\Models\Doctor::findOrFail($data->doctor_id);
								@endphp

								<tr>
									@php
                                        $rowNumber = ($invoices->currentPage() - 1) * $invoices->perPage() + $loop->iteration;
                                    @endphp
                                    <td>{{ $rowNumber }}</td>
									<td>{{ $doctor->name }}</td>
									<td>
										{{ number_format($data->amount) }}
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success finished-progress-bar" style="with:0%;">{{ $data->paymentSum() . ', ' . $data->amount }}</div>
                                        </div>
									</td>
									
									@if($data->description != null)
										<td>
											<a href="#" class="btn btn-warning" onclick="openDescriptionModal('{{ $data->id }}', 'invoices')"
											data-toggle="modal" data-target="#descriptionmodal">
												<span>تماشا</span>
											</a>
										</td>
									@else
										<td style="color:red;">هیچ توضیحی وجود ندارن</td>
									@endif

									@if ($data->status == '1')
										<td>
											<span class="badge badge-success">پرداخت شده</span>
										</td>
									@else
										<td>
											<span class="badge badge-danger">پرداخت نشده</span>
										</td>
									@endif
									<td>
										<div class="d-flex">
											<a href="{{ route('invoices.show', $data->id) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش">
													<i class="feather feather-eye text-primary"></i>
												</a>
											<a href="{{ route('invoices.edit', $data->id) }}" class="action-btns1">
												<i class="feather feather-edit-2  text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش"></i>
											</a>
											<a href="#" data-id="{{ $data->id }}" class="action-btns1 role-invoice" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">
												<i class="feather feather-trash-2 text-danger"></i>
											</a>

                                            @if($data->status != 1)
                                                <a href="#" class="action-btns1" data-toggle="modal" id="payment_modal" 
                                                data-target="#paymentmodal" onclick="fillPaymentVariables('{{ $data->id }}', '{{ number_format($data->amount - $data->paymentSum()) }}')">
                                                    <i class="feather feather-dollar-sign text-success"></i>
                                                </a>
                                            @endif
										</div>
									</td>
								</tr>

							@endforeach
						</tbody>
					</table>
					@if(count($invoices) === 0)
						<div class="text-center text-danger" style="font-family: unset;">هیچ داده ای وجود ندارد</div>
					@endif
				</div>
				{!! $invoices->links('vendor.pagination.bootstrap-4') !!}
			</div>
		</div>
	</div>
</div>
@endcan
<!-- End Row -->

<!--Store payment modal -->
<div class="modal fade" id="paymentmodal">
	<div class="modal-dialog" role="document">
		<x-errors></x-errors>
		<div class="modal-content">
			<form action="{{ route('payments.store') }}" class="card-body pt-3" id="payment" name="payment" method="post" enctype="multipart/form-data">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">پرداخت صورت حساب</h5>
					<button  class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="form-group required">
							<div class="d-flex" style="justify-content: space-between;">
								<small class="form-text" style="color:green;">حداقل الزام پرداخت:	25,000 تومان</small>
								<small class="form-text" style="color:red;" id="amount_maximum"></small>
							</div>
							<label class="form-label">مبلغ برای پرداخت</label>
                            <div class="d-flex" style="align-items: center;gap:10px;">
                                <input type="text" class="form-control amount" value="{{ number_format(old('amount')) }}" onkeyup="amountChange(this.value)" placeholder="مبلغ به تومان">
                                <input type="hidden" name="amount" value="{{ old('amount') }}" id="amount">
                                <small>تومان</small>
                            </div>
						</div>

						<div class="form-group required">
							<label class="form-label">نوع پرداخت</label>
							<select class="form-control custom-select select2" onchange="payTypeSelect(this)" name="pay_type" data-placeholder="انتخاب نوع پرداخت">
								<option label="انتخاب نوع پرداخت"></option>
								<option value="cash">نقد</option>
								<option value="cheque">چک</option>
							</select>
						</div>

						<div class="form-group required" id="due_date_input" style="display:none;">
							<label class="form-label">زمان سررسید</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" id="dp-due-date">
										<span class="feather feather-calendar"></span>
									</div>
								</div><input class="form-control fc-datepicker hasDatepicker" value="{{ old('due_date') }}" id="dp-due-date-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
								<input type="hidden" value="{{ old('due_date') }}" id="dp-due-date-date" name="due_date" aria-label="date11" aria-describedby="date11">
							</div>
						</div>

						<div class="form-group">
							<label class="form-label">تصویر</label>
							<input type="file" class="dropify" id="image" data-height="180" name="receipt" accept=".jpg, .jpeg, .png" />
						</div>

						<div class="form-group">
							<label class="form-label">توضیحات</label>
							<textarea class="form-control" name="description" id="example" style="min-width: 0px;">{{ old('description') }}</textarea>
						</div>

						<input type="hidden" name="invoice_id" id="invoice_id">
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-outline-primary" data-dismiss="modal">بستن</a>
					<button class="btn btn-success" type="submit">پرداخت</button>
				</div>
			</form>
		</div>
	</div>
</div>
@if ($errors->any())
	<script>
		window.addEventListener('load', function() {
			document.getElementById('payment_modal').click();
		});
	</script>	
@endif
<!-- End store payment modal  -->

<!--Show description modal -->
<div class="modal fade" id="descriptionmodal">
	<div class="modal-dialog" role="document">
		<x-errors></x-errors>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">توضیحات صورت حساب</h5>
				<button  class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
			<div class="form-group" id="description_body"></div>
			<div class="modal-footer">
				<a href="#" class="btn btn-outline-primary" data-dismiss="modal">بستن</a>
			</div>
		</div>
	</div>
</div>
@if (session('error'))
	<script>
		window.addEventListener('load', function() {
			document.getElementById('payment_modal').click();
		});
	</script>	
@endif
<!-- End Change description modal  -->

@endsection
@section('scripts')
	<script src="{{ asset('assets/plugins/jquery.md.bootstrap.datetimepicker.js') }}"></script>
	<script src="{{ asset('assets/js/calendar.js') }}"></script>

	<script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
	
	<script src="{{ asset('assets/js/comma.js') }}"></script>

	<script src="{{ asset('assets/js/invoice.js') }}"></script>

	<script src="{{ asset('assets/js/open-description.js') }}"></script>
	
	<!-- INTERNAL File uploads js -->
	<script src="{{ asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
	<script src="{{ asset('assets/js/filupload.js') }}"></script>
@endsection
