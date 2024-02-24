@extends('layouts.admin.master')
@section('title', 'صورت حساب ها')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
@can('view operations')
<div class="row">
	<div class="col-md-12">
		<div class="card">
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
									<td>{{ $loop->iteration }}</td>
									<td>{{ $doctor->name }}</td>
									<td>{{ number_format($data->amount) }}</td>
									<td>{{ $data->description }}</td>
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
											<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="پرداخت">
												<i class="feather feather-dollar-sign text-success"></i>
											</a>
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
@endsection
@section('scripts')
	<script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
	
	<script src="{{ asset('assets/js/comma.js') }}"></script>
@endsection
