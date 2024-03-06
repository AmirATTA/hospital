@extends('layouts.admin.master')
@section('title', "پرداخت دکتر $doctorName->name")
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
					<div class="checkbox-wrapper-19 select-all-checkbox">
						<label for="select_all" style="cursor:pointer;">انتخاب همه</label>
						<input type="checkbox" id="select_all" />
						<label for="select_all" class="check-box"></label>
					</div>
					<form action="{{ route('doctor-surgeries.store') }}" id="doctor-surgery" name="doctor-surgery" method="post" >
						@csrf
						<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
							<thead>
								<tr>
									<th class="border-bottom-0"></th>
									<th class="border-bottom-0">ردیف</th>
									<th class="border-bottom-0">نام بيمار</th>
									<th class="border-bottom-0">جمع كل عمل ها (به تومان)</th>
									<th class="border-bottom-0">سهم دكتر از جراحي (به تومان)</th>
									<th class="border-bottom-0">نقش دكتر</th>
								</tr>
							</thead>
							<tbody>
								@foreach($surgeries as $data)

									@php
										$doctor = App\Models\Doctor::findOrFail($doctorId);
										$doctorRoleId = App\Models\DoctorSurgery::where('doctor_id', $doctorId)->where('surgery_id', $data)->pluck('doctor_role_id');
										$doctorRole = App\Models\DoctorRole::where('id', $doctorRoleId[0])->get();

										$doctorSurgery = App\Models\DoctorSurgery::where('doctor_id', $doctorId)->where('surgery_id', $data)->get()[0];

                                        $surgery = App\Models\Surgery::where('id', $data)->get()[0];
									@endphp

									@if($doctorSurgery->invoice_id == null)

										<tr>
											<td>
												<div class="checkbox-wrapper-19" style="display: flex;align-items: center;justify-content: center;">
													<input type="checkbox" name="invoices[]" value="{{ $doctorId .', '. $surgery->getDoctorQuotaAmount($doctorRole[0]) .', '. $doctorSurgery->id }}" class="checkbox" id="cbtest-{{ $surgery->id }}" />
													<label for="cbtest-{{ $surgery->id }}" class="check-box"></label>
                                                    <input type="hidden" value="{{ $surgery->getTotalPrice() }}" class="operation-sum">
                                                    <input type="hidden" value="{{ $surgery->getDoctorQuotaAmount($doctorRole[0]) }}" class="quota-sum">
												</div>
											</td>
                                            <td>{{ $loop->iteration }}</td>
											<td>{{ $surgery->patient_name }}</td>
											<td>{{ number_format($surgery->getTotalPrice()) }} تومان</td>
											<td>{{ number_format($surgery->getDoctorQuotaAmount($doctorRole[0])) }} تومان <span style="color:red;">{{ $doctorRole[0]->quota }}%</span></td>
											<td>{{ $doctorRole[0]->title }}</td>
										</tr>

									@endif

								@endforeach
							</tbody>
                            <td></td>
                            <td>جمع کل</td>
                            <td></td>
                            <td id="operation_sum">0 تومان</td>
                            <td id="quota_sum">0 تومان</td>
						</table>
					    @if(count($surgeries) !== 0)
                            <div class="invoice-btn" style="display:flex;justify-content: center;margin-top:15px;">
                                <button type="submit" class="btn btn-success btn-lg" id="invoice_btn">ثبت صورت حساب</button>
                            </div>
					    @endif
					</form>
					@if(count($surgeries) === 0)
						<div class="text-center text-danger" style="font-family: unset;">هیچ داده ای وجود ندارد</div>
					@endif
				</div>
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

	<script src="{{ asset('assets/js/select-all.js') }}"></script>
@endsection