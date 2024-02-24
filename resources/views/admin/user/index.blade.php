@extends('layouts.admin.master')
@section('title', 'لیست کاربر ها')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')

@can('create users')
	<a href="{{ route('users.create') }}"><button class="btn btn-primary news-btn">کاربر جدید +</button></a>
@endcan

<!-- Row -->
@can('view users')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
						<thead>
							<tr>
								<th class="border-bottom-0">ردیف</th>
								<th class="border-bottom-0">نام و نام خانوادگی</th>
								<th class="border-bottom-0">شماره تلفن</th>
								<th class="border-bottom-0">آدرس ایمیل</th>
								<th class="border-bottom-0">تاریخ ثبت</th>
								<th class="border-bottom-0">اقدامات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $data)

								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $data->name }}</td>
									<td>{{ $data->mobile }}</td>
									<td>{{ $data->email }}</td>
									<td>{{ $data->created_at->diffForHumans(); }}</td>
									<td>
										<div class="d-flex">
											<a href="{{ route('users.edit', $data->id) }}" class="action-btns1">
												<i class="feather feather-edit-2  text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش"></i>
											</a>
											<a href="#" data-id="{{ $data->id }}" class="action-btns1 role-user" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">
												<i class="feather feather-trash-2 text-danger"></i>
											</a>
										</div>
									</td>
								</tr>

							@endforeach
						</tbody>
					</table>
					@if(count($users) === 0)
						<div class="text-center text-danger" style="font-family: unset;">هیچ داده ای وجود ندارد</div>
					@endif
				</div>
				{!! $users->links('vendor.pagination.bootstrap-4') !!}
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
