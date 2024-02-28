@extends('layouts.admin.master')
@section('title', 'لیست تخصص ها')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')

@can('create specialities')
	<a href="{{ route('specialities.create') }}"><button class="btn btn-primary news-btn">تخصص جدید +</button></a>
@endcan

<!-- Row -->
@can('view specialities')
<div class="row">
	<div class="col-md-12">
		<div class="card">

            <!-- Search & filter -->
            <form action="{{ route('specialities.search') }}" method="GET">
                <div class="form-group mt-5 d-flex" 
                style="margin:10px 25px;align-items: center;justify-content: space-between;flex-wrap: wrap;">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" value="@php if(isset($search['title'])){echo $search['title'];}@endphp" name="title" placeholder="جستجو برای نام دکتر">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">جستجو</button>
                            </span>
                        </div>
                    </div>
                    <div class="card-footer text-left" style="width: 100%;">
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
								<th class="border-bottom-0">عنوان</th>
								<th class="border-bottom-0">وضعیت</th>
								<th class="border-bottom-0">اقدامات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($specialities as $data)

								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $data->title }}</td>
									@if ($data->status == '1')
										<td>
											<span class="badge badge-success">فعال</span>
										</td>
									@else
										<td>
											<span class="badge badge-danger">غیر فعال</span>
										</td>
									@endif
									<td>
										<div class="d-flex">
											<a href="{{ route('specialities.edit', $data->id) }}" class="action-btns1">
												<i class="feather feather-edit-2  text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش"></i>
											</a>
											<a href="#" data-id="{{ $data->id }}" class="action-btns1 role-speciality" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">
												<i class="feather feather-trash-2 text-danger"></i>
											</a>
										</div>
									</td>
								</tr>

							@endforeach
						</tbody>
					</table>
					@if(count($specialities) === 0)
						<div class="text-center text-danger" style="font-family: unset;">هیچ داده ای وجود ندارد</div>
					@endif
				</div>
				{!! $specialities->links('vendor.pagination.bootstrap-4') !!}
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
