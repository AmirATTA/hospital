@extends('layouts.admin.master')
@section('title', 'لیست گزارش فعالیت')
@section('links')
	<link href="{{ asset('assets/css/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet"/>

	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->

@can('delete activity-logs')
	<a href="#" data-id="all" class="action-btns1 role-activity-log"><button class="btn btn-danger news-btn">حذف همه
		<i class="feather feather-trash-2"></i>
	</button></a>
@endcan

@can('view activity-logs')
	<div class="row">
		<div class="col-md-12">
			<div class="card">

                <!-- Search & filter -->
                <form action="{{ route('activity-logs.search') }}" method="GET">
                    <div class="form-group mt-5 d-flex" 
                    style="margin:10px 25px;align-items: center;justify-content: space-between;flex-wrap: wrap;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">از تاریخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" id="dp-start">
                                            <span class="feather feather-calendar"></span>
                                        </div>
                                    </div><input class="form-control fc-datepicker hasDatepicker" value="{{ old('search[]') }}" id="dp-start-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
                                    <input type="hidden" value="{{ old('search[]') }}" id="dp-start-date" name="search[]" aria-label="date11" aria-describedby="date11">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">تا تاریخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" id="dp-end">
                                            <span class="feather feather-calendar"></span>
                                        </div>
                                    </div><input class="form-control fc-datepicker hasDatepicker" value="{{ old('search[]') }}" id="dp-end-text" placeholder="YYYY/MM/DD" type="text" aria-label="date1" aria-describedby="date1">
                                    <input type="hidden" value="{{ old('search[]') }}" id="dp-end-date" name="search[]" aria-label="date11" aria-describedby="date11">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">تخصص</label>
                                <select class="form-control custom-select select2" name="search[]" data-placeholder="انتخاب موضوع">
                                    <option label="انتخاب موضوع"></option>
                                    @foreach($subjects as $item)										
                                        <option value="{{ $item }}" @selected($item == $search[2])>{{ __('custom.'. $item) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-left" style="width: 100%;">
                            <button type="submit" class="btn btn-primary btn-block">جستجو</button>
                        </div>
                    </div>
                </form>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
							<thead>
								<tr>
									<th class="border-bottom-0">ردیف</th>
									<th class="border-bottom-0">گزارش</th>
									<th class="border-bottom-0">زمان اتفاق</th>
									<th class="border-bottom-0">سازنده</th>
									<th class="border-bottom-0">اقدامات</th>
								</tr>
							</thead>
							<tbody>
								@foreach($activityLogs as $data)

									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $data->description }}</td>
										<td>{{ $data->created_at->diffForHumans() }}</td>
										<td>{{ App\Models\User::where('id', $data->causer_id)->pluck('name')->first() }}</td>
										<td>
											<div class="d-flex">
												<a href="{{ route('activity-logs.show', $data->id) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش">
													<i class="feather feather-eye text-primary"></i>
												</a>
												<a href="#" data-id="{{ $data->id }}" class="action-btns1 role-activity-log" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">
													<i class="feather feather-trash-2 text-danger"></i>
												</a>
											</div>
										</td>
									</tr>

								@endforeach
							</tbody>
						</table>
						@if(count($activityLogs) === 0)
							<div class="text-center text-danger">هیچ داده ای وجود ندارد</div>
						@endif
					</div>
					{!! $activityLogs->links('vendor.pagination.bootstrap-4') !!}
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
@endsection
