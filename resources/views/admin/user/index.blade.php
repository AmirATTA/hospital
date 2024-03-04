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

            <!-- Search & filter -->
            <form action="{{ route('users.search') }}" method="GET">
                <div class="form-group mt-5 d-flex" 
                style="margin:10px 25px;align-items: center;justify-content: space-evenly;flex-wrap: wrap;">
                    <div class="col-md-6">
                        <label class="form-label">نام و نام خانوادگی</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="@php if(isset($search['name'])){echo $search['name'];}@endphp" name="name" placeholder="جستجو برای نام و نام خانوادگی">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">شماره تلفن</label>
                        <div class="input-group">
                            <input type="number" class="form-control" value="@php if(isset($search['mobile'])){echo $search['mobile'];}@endphp" name="mobile" placeholder="جستجو برای شماره تلفن">
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
									@php
                                        $rowNumber = ($users->currentPage() - 1) * $users->perPage() + $loop->iteration;
                                    @endphp
                                    <td>{{ $rowNumber }}</td>
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
