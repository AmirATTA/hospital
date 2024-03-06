@extends('layouts.admin.master')
@section('content')
<!-- Row -->
<div style="margin-bottom:25px;position: relative;bottom: 100px;display: flex;justify-content: flex-end;">
    <button class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> پرینت از صورت حساب</button>
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
                
                <div class="table-responsive push">
                    <h2 class="mb-1" style="font-size:2rem;">جراحی ها</h2>
                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
						<thead>
							<tr>
								<th class="border-bottom-0">ردیف</th>
								<th class="border-bottom-0">نام بیمار</th>
								<th class="border-bottom-0">کدملی بیمار</th>
								<th class="border-bottom-0">بیمه</th>
								<th class="border-bottom-0">قیمت</th>
								<th class="border-bottom-0">تاریخ جراحی</th>
							</tr>
						</thead>
						<tbody>
							@foreach($surgeries as $data)

								<tr>
                                    <td>{{ $loop->iteration }}</td>
									<td>{{ $data->patient_name }}</td>
									<td>{{ $data->patient_national_code }}</td>
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
									<td>{{ number_format($data->getTotalPrice()) }} تومان</td>
                                    <td>{{ convertToJalaliDate($data->surgeried_at, true) }}</td>
								</tr>

							@endforeach
						</tbody>
                        <td>جمع کل</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($surgeriesTotalPrice) }} تومان</td>
					</table>
                </div>

                <hr>
                <span style="display:block;text-align:center;">سحم دکتر از جراحی: {{ number_format($doctorRoleQuotaAmount) }} تومان</span>
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
									<td>{{ number_format($data->amount) }} تومان</td>
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
                        <td>جمع کل</td>
                        <td>{{ number_format($invoice->paymentSum()) }} تومان</td>
					</table>
                </div>


                <div class="card-body pl-0 pr-0" style="margin-bottom:150px;">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="text-muted">محل امضا حسابدار</span>
                        </div>
                        <div class="col-sm-6 text-left">
                            <span class="text-muted">محل امضا دکتر</span>
                        </div>
                    </div>
                </div>

                <p class="text-muted text-center">از اینکه با ما همکاری کردید بسیار سپاسگزاریم. ما مشتاقانه منتظر همکاری مجدد با شما هستیم!</p>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/progress-bar.js') }}"></script>

    <script src="{{ asset('assets/js/view-page.js') }}"></script>

    <script src="{{ asset('assets/js/comma.js') }}"></script>
@endsection
