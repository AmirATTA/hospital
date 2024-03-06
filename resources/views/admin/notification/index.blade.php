@extends('layouts.admin.master')
@section('title', 'لیست اعلانات')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
						<thead>
							<tr>
								<th class="border-bottom-0">ردیف</th>
								<th class="border-bottom-0">عنوان</th>
								<th class="border-bottom-0">تاریخ بازدید</th>
								<th class="border-bottom-0">تاریخ ساخت</th>
								<th class="border-bottom-0">اقدامات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($notifications as $data)

								<tr>
									@php
                                        $rowNumber = ($notifications->currentPage() - 1) * $notifications->perPage() + $loop->iteration;
                                    @endphp
                                    <td>{{ $rowNumber }}</td>
									<td>{{ $data->title }}</td>
									@php
										$viewedAt = ($data->viewed_at != null) ? $data->viewed_at : 'هنوز بازدید نشده';
									@endphp
									<td @if($viewedAt == 'هنوز بازدید نشده') style="color:red;" @endif>{{ $viewedAt }}</td>
									<td>{{ $data->created_at->diffForHumans() }}</td>
									<td>
										<div class="d-flex">
											<a href="{{ route('notifications.show', $data->id) }}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="نمایش">
												<i class="feather feather-eye text-primary"></i>
											</a>
										</div>
									</td>
								</tr>

							@endforeach
						</tbody>
					</table>
					@if(count($notifications) === 0)
						<div class="text-center text-danger" style="font-family: unset;">هیچ داده ای وجود ندارد</div>
					@endif
				</div>
				{!! $notifications->links('vendor.pagination.bootstrap-4') !!}
			</div>
		</div>
	</div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
	<script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
	
	<script src="{{ asset('assets/js/comma.js') }}"></script>
@endsection
