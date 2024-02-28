@extends('layouts.admin.master')
@section('title', 'لیست عمل ها')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')

@can('create insurances')
	<a href="{{ route('insurances.create') }}"><button class="btn btn-primary news-btn">بيمه جدید +</button></a>
@endcan

<!-- Row -->
@can('view insurances')
<div class="row">
	<div class="col-md-12">
		<div class="card">

                <!-- Search & filter -->
                <form action="{{ route('insurances.search') }}" method="GET">
                    <div class="form-group mt-5 d-flex" 
                    style="margin:10px 25px;align-items: center;justify-content: space-evenly;flex-wrap: wrap;">
                        <div class="col-md-6">
                            <label class="form-label">نام</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="@php if(isset($search['name'])){echo $search['name'];}@endphp" name="name" placeholder="جستجو برای نام">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">نوع</label>
                                <select class="form-control custom-select select2" name="type" data-placeholder="انتخاب موضوع">
                                    <option label="انتخاب موضوع"></option>
                                    <option value="basic" @selected(isset($search['type']) && 'basic' == $search['type'])>پایه</option>
                                    <option value="supplementary" @selected(isset($search['type']) && 'supplementary' == $search['type'])>تکمیلی</option>
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
								<th class="border-bottom-0">نام</th>
								<th class="border-bottom-0">نوع</th>
								<th class="border-bottom-0">تخفيف</th>
								<th class="border-bottom-0">وضعیت</th>
								<th class="border-bottom-0">اقدامات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($insurances as $data)

								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $data->name }}</td>
									<td>
										@if($data->type == 'basic')
											پايه
										@elseif($data->type == 'supplementary')
											تكميلي
										@endif
									</td>
									<td>{{ $data->discount }}%</td>
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
											<a href="{{ route('insurances.edit', $data->id) }}" class="action-btns1">
												<i class="feather feather-edit-2  text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش"></i>
											</a>
											<a href="#" data-id="{{ $data->id }}" class="action-btns1 role-insurance" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">
												<i class="feather feather-trash-2 text-danger"></i>
											</a>
										</div>
									</td>
								</tr>

							@endforeach
						</tbody>
					</table>
					@if(count($insurances) === 0)
						<div class="text-center text-danger" style="font-family: unset;">هیچ داده ای وجود ندارد</div>
					@endif
				</div>
				{!! $insurances->links('vendor.pagination.bootstrap-4') !!}
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
