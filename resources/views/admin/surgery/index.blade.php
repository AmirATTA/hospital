@extends('layouts.admin.master')
@section('title', 'لیست عمل جراحی ها')
@section('links')
	<link href="{{ asset('assets/css/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet"/>

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

                <!-- Search & filter -->
                <form action="{{ route('surgeries.search') }}" method="GET">
                    <div class="form-group mt-5 d-flex" 
                    style="margin:10px 25px;align-items: center;justify-content: space-between;flex-wrap: wrap;">
                        <div class="col-md-6">
                            <label class="form-label">شماره سند</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="@php if(isset($search['document_number'])){echo $search['document_number'];}@endphp" name="document_number" placeholder="جستجو برای شماره سند">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">نام بیمار</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="@php if(isset($search['patient_name'])){echo $search['patient_name'];}@endphp" name="patient_name" placeholder="جستجو برای نام بیمار">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">از تاریخ جراحی</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" id="dp-surgeried">
                                            <span class="feather feather-calendar"></span>
                                        </div>
                                    </div><input class="form-control fc-datepicker hasDatepicker" value="@php if(isset($search['fromSurgeriedDate'])){echo $search['fromSurgeriedDate'];}@endphp" id="dp-surgeried-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
                                    <input type="hidden" value="@php if(isset($search['fromSurgeriedDate'])){echo $search['fromSurgeriedDate'];}@endphp" id="dp-surgeried-date" name="fromSurgeriedDate" aria-label="date11" aria-describedby="date11">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">تا تاریخ جراحی</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" id="dp-surgeried-to">
                                            <span class="feather feather-calendar"></span>
                                        </div>
                                    </div><input class="form-control fc-datepicker hasDatepicker" value="@php if(isset($search['toSurgeriedDate'])){echo $search['toSurgeriedDate'];}@endphp" id="dp-surgeried-to-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
                                    <input type="hidden" value="@php if(isset($search['toSurgeriedDate'])){echo $search['toSurgeriedDate'];}@endphp" id="dp-surgeried-to-date" name="toSurgeriedDate" aria-label="date11" aria-describedby="date11">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">از تاریخ مرخصی</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" id="dp-released">
                                            <span class="feather feather-calendar"></span>
                                        </div>
                                    </div><input class="form-control fc-datepicker hasDatepicker" value="@php if(isset($search['fromReleaseDate'])){echo $search['fromReleaseDate'];}@endphp" id="dp-released-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
                                    <input type="hidden" value="@php if(isset($search['fromReleaseDate'])){echo $search['fromReleaseDate'];}@endphp" id="dp-released-date" name="fromReleasedDate" aria-label="date11" aria-describedby="date11">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">تا تاریخ مرخصی</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" id="dp-released-to">
                                            <span class="feather feather-calendar"></span>
                                        </div>
                                    </div><input class="form-control fc-datepicker hasDatepicker" value="@php if(isset($search['toReleaseDate'])){echo $search['toReleaseDate'];}@endphp" id="dp-released-to-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
                                    <input type="hidden" value="@php if(isset($search['toReleaseDate'])){echo $search['toReleaseDate'];}@endphp" id="dp-released-to-date" name="toReleasedDate" aria-label="date11" aria-describedby="date11">
                                </div>
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
										@php
                                            $rowNumber = ($surgeries->currentPage() - 1) * $surgeries->perPage() + $loop->iteration;
                                        @endphp
                                        <td>{{ $rowNumber }}</td>
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
													<i class="feather feather-edit-2  text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش"></i>
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
							<div class="text-center text-danger">هیچ داده ای وجود ندارد</div>
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
    <script src="{{ asset('assets/plugins/jquery.md.bootstrap.datetimepicker.js') }}"></script>
	<script src="{{ asset('assets/js/calendar.js') }}"></script>

	<script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
	
	<script src="{{ asset('assets/js/comma.js') }}"></script>
@endsection
