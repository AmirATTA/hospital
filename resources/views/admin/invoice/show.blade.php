@extends('layouts.admin.master')
@section('content')
<div style="margin-bottom:25px;position: relative;bottom: 100px;">
    <button class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
</div>

<div class="row" style="position: relative;bottom: 100px;" id="invoice_container">
    <div class="col-md-12">
        <div class="card overflow-hidden">
            <div class="card-body">
                <a class="header-brand" style="margin:auto;display: flex;flex-direction: column;align-items: center;margin-top:25px;">
                    <img src="{{ asset('assets/images/hospital_logo.png') }}" class="header-brand-image dark-logo" alt="Dayonelogo">
                    <h2 class="mb-1" style="margin:0;font-size:2rem;">صورت حساب</h2>
                    <h2 class="mb-1" style="margin:0;font-size:2rem;">بیمارستان</h2>
                </a>
                <div class="d-flex" style="flex-direction: column;">
                    <h5 class="mb-1">شماره شناسه: <strong>{{ $invoice->id }}</strong></h5>
                    <span>تاریخ ثبت صورت حساب: <strong>{{ convertToJalaliDate($invoice->created_at, true) }}</strong></span>
                    <span>توسط مدیر بیمارستان - <strong>{{ Auth::user()->name }}</strong></span>
                    <span>دکتر مورد نظر - <strong>{{ $doctor->name }}</strong></span>
                </div>

                <div class="card-body pl-0 pr-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="text-muted">محل امضا مدیر</span>
                        </div>
                        <div class="col-sm-6 text-left">
                            <span class="text-muted">محل امضا دکتر</span>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive push">
                    <h2 class="mb-1" style="font-size:2rem;">عمل ها</h2>
                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
						<thead>
							<tr>
								<th class="border-bottom-0">ردیف</th>
								<th class="border-bottom-0">نام</th>
								<th class="border-bottom-0">قیمت</th>
								<th class="border-bottom-0">وضعیت</th>
								<th class="border-bottom-0">در تاریخ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($operations as $data)

								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $data[0]->name }}</td>
									<td class="comma">{{ $data[0]->price }}</td>
									@if ($data[0]->status == '1')
										<td>
											<span class="badge badge-success">فعال</span>
										</td>
									@else
										<td>
											<span class="badge badge-danger">غیر فعال</span>
										</td>
									@endif
                                    <td>{{ convertToJalaliDate($data[0]->created_at, true) }}</td>
								</tr>

							@endforeach
						</tbody>
					</table>
                    <span>جمع کل: {{ number_format($surgery[0]->getTotalPrice()) }} - سهم دكتر از جراحي: {{ number_format($surgery[0]->getDoctorQuotaAmount($doctor->doctorRoles[0])) }}</span>
                </div>

                <hr>

                <div class="table-responsive push">
                    <h2 class="mb-1" style="font-size:2rem;">پرداخت ها</h2>
                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
						<thead>
							<tr>
								<th class="border-bottom-0">ردیف</th>
								<th class="border-bottom-0">مبلغ</th>
								<th class="border-bottom-0">نقدی/چک</th>
								<th class="border-bottom-0">زمان سررسید چک</th>
								<th class="border-bottom-0">در تاریخ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($payments as $data)

								<tr>
									<td>{{ $loop->iteration }}</td>
									<td class="comma">{{ $data->amount }}</td>
                                    @if($data->pay_type == 'cash')
                                        <td>
                                            <span class="badge badge-success">نقدی</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-primary">چک</span>
                                        </td>
                                    @endif
                                    @if($data->due_date != null)
                                        <td>{{ convertToJalaliDate($data->due_date, true) }}</td>
                                    @else
                                        <td><span class="badge badge-warning">پرداخت نقدی</span></td>
                                    @endif
                                    <td>{{ convertToJalaliDate($data->created_at, true) }}</td>
								</tr>

							@endforeach
						</tbody>
					</table>
                    <span>{{ number_format($invoice->paymentSum()) }} از {{ number_format($surgery[0]->getDoctorQuotaAmount($doctor->doctorRoles[0])) }} پرداخت شده!</span>
                </div>
                <p class="text-muted text-center">از اینکه با ما همکاری کردید بسیار سپاسگزاریم. ما مشتاقانه منتظر همکاری مجدد با شما هستیم!</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/progress-bar.js') }}"></script>

    <script src="{{ asset('assets/js/view-page.js') }}"></script>
@endsection
