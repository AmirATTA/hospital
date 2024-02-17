@extends('layouts.admin.master')
@section('title', 'لیست گزارش فعالیت')
@section('links')
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
								@foreach($activityLog as $data)

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
						@if(count($activityLog) === 0)
							<div class="text-center text-danger">هیچ داده ای وجود ندارد</div>
						@endif
					</div>
					{!! $activityLog->links('vendor.pagination.bootstrap-4') !!}
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
@endsection
