@extends('layouts.admin.master')
@section('title', 'لیست دکتر ها')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">
		<div class="card">

            <!-- Search & filter -->
            <form action="{{ route('payments.search') }}" method="GET">
                <div class="form-group mt-5 d-flex" 
                style="margin:10px 25px;align-items: center;justify-content: space-between;flex-wrap: wrap;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">دکتر</label>
                            <select class="form-control custom-select select2" name="invoice_id" data-placeholder="انتخاب دکتر">
                                <option label="انتخاب دکتر"></option>
                                @foreach($invoices as $invoice)			
                                
                                    @php $doctorName = App\Models\Doctor::where('id', $invoice->doctor_id)->select('name')->get(); @endphp
                                
                                    <option value="{{ $invoice->id }}" @selected(isset($search['invoice_id']) && $invoice->id == $search['invoice_id'])>{{ $doctorName[0]['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">نوع پرداخت</label>
                            <select class="form-control custom-select select2" name="pay_type" data-placeholder="انتخاب نوع پرداخت">
                                <option label="انتخاب نوع پرداخت"></option>
                                <option value="cash" @selected(isset($search['pay_type']) && 'cash' == $search['pay_type'])>نقدی</option>
                                <option value="cheque" @selected(isset($search['pay_type']) && 'cheque' == $search['pay_type'])>چک</option>
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
                                <th class="border-bottom-0">مبلغ</th>
                                <th class="border-bottom-0">توضیحات</th>
                                <th class="border-bottom-0">چک/نقدی</th>
                                <th class="border-bottom-0">زمان سررسید</th>
								<th class="border-bottom-0">وضعیت</th>
                                <th class="border-bottom-0">اقدامات</th>
                            </tr>
						</thead>
						<tbody>
							@foreach($payments as $data)

                                @php 
                                    $invoice = App\Models\Invoice::where('id', $data->invoice_id)->first(); 
                                    $doctorName = App\Models\Doctor::where('id', $invoice->doctor_id)->select('name')->get(); 
                                @endphp

								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $doctorName[0]['name'] }}</td>
									<td>{{ $data->amount }}</td>
                                    @if($data->description != null)
										<td>
											<a href="#" class="btn btn-warning" onclick="openDescriptionModal('{{ $data->id }}', 'payments')"
											data-toggle="modal" data-target="#descriptionmodal">
												<span>تماشا</span>
											</a>
										</td>
									@else
										<td style="color:red;">هیچ توضیحی وجود ندارن</td>
									@endif
									@if($data->pay_type == 'cash')
                                        <td>
                                            <span class="badge badge-success">نقدی</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-primary">چک</span>
                                        </td>
                                    @endif
                                    @if($data->due_date != null)
                                        <td>{{ convertToJalaliDate($data->due_date, true) }}</td>
                                    @else
                                        <td><span class="badge badge-warning">پرداخت نقدی</span></td>
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
											<a href="{{ route('payments.show', $data->id) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش">
													<i class="feather feather-eye text-primary"></i>
												</a>
											<a href="{{ route('payments.edit', $data->id) }}" class="action-btns1">
												<i class="feather feather-edit-2  text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش"></i>
											</a>
										</div>
									</td>
								</tr>

							@endforeach
						</tbody>
					</table>
					@if(count($payments) === 0)
						<div class="text-center text-danger" style="font-family: unset;">هیچ داده ای وجود ندارد</div>
					@endif
				</div>
				{!! $payments->links('vendor.pagination.bootstrap-4') !!}
			</div>
		</div>
	</div>
</div>
<!-- End Row -->

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
	<script src="{{ asset('assets/js/open-description.js') }}"></script>

    <script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endsection
