@extends('layouts.admin.master')
@section('title', 'لیست عمل جراحی ها')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')

@can('create surgeries')
	<a href="{{ route('surgeries.create') }}"><button class="btn btn-primary news-btn">عمل جراحی جدید +</button></a>
@endcan

<!-- Row -->
@can('view surgeries')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
							<thead>
								<tr>
									<th class="border-bottom-0">ردیف</th>
									<th class="border-bottom-0">شماره سند</th>
									<th class="border-bottom-0">نام بیمار</th>
									<th class="border-bottom-0">بیمه</th>
									<th class="border-bottom-0">زمان جراحی</th>
									<th class="border-bottom-0">زمان مرخصی</th>
									<th class="border-bottom-0">اقدامات</th>
								</tr>
							</thead>
							<tbody>
								@foreach($surgeries as $data)

									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $data->document_number }}</td>
										<td>{{ $data->patient_name }}</td>

										<?php
											$insurance = ($data->basic_insurance_id != null) ? $data->basic_insurance_id : $data->supp_insurance_id;

											$insurance = App\Models\Insurance::where('id', $insurance)->pluck('type')->first();

											if($insurance == 'basic') {
												$insurance = 'پایه';
											} else if($insurance == 'supplementary') {
												$insurance = 'تکمیلی';
											} else {
												$insurance = 'بیمار پوشش بیمه ای نیست';
											}
										?>

										<td @if($insurance == 'بیمار پوشش بیمه ای نیست') style="color:red;" @endif>{{ $insurance }}</td>
										<td>{{ convertToJalaliDate($data->surgeried_at, true) }}</td>
										<td>{{ convertToJalaliDate($data->released_at, true) }}</td>
										<td>
											<div class="d-flex">
												<a href="{{ route('surgeries.show', $data->id) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش">
													<i class="feather feather-eye text-primary"></i>
												</a>
												<a href="{{ route('surgeries.edit', $data->id) }}" class="action-btns1">
													<i class="feather feather-edit-2  text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش"></i>
												</a>
												<a href="#" data-id="{{ $data->id }}" class="action-btns1 role-surgery" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">
													<i class="feather feather-trash-2 text-danger"></i>
												</a>
											</div>
										</td>
									</tr>

								@endforeach
							</tbody>
						</table>
						@if(count($surgeries) === 0)
							<div class="text-center text-danger" style="font-family: unset;">هیچ داده ای وجود ندارد</div>
						@endif
					</div>
					{!! $surgeries->links('vendor.pagination.bootstrap-4') !!}
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
