@extends('layouts.admin.master')
@section('content')
<!-- Row -->
<!-- <div class="row">
    <div class="col-xl-7 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="card-header border-0 mb-1">
                        <h4 class="card-title" style="font-size:2rem;">صورت حساب</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                <td>
                                    <div class="d-flex" style="align-items: center;gap:5px;">
                                        <span class="font-weight-semibold">مبلغ:</span> 
                                        <span style="color:#00cf00;">{{ number_format($invoice->amount) }}</span> تومان
                                        <div class="progress progress-sm" style="min-width: 150px;right:10px;position:relative;">
                                            <div class="progress-bar bg-success finished-progress-bar" 
                                            style="width: 120px;">{{ $invoice->paymentSum() . ', ' . $invoice->amount }}</div>
                                        </div>
                                        <span style="color:#00cf00;right:25px;position:relative;" id="percentage_text">25%</span>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">نام دکتر :</span> <a href="{{ route('doctors.show', $doctor->id) }}">{{ $doctor->name }}</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">بدنه</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                {!! $invoice->description !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="list-id mb-2">
                    <div class="row" style="justify-content: center;">
                        <div class="col col-auto">
                            @if($invoice->status == "0")
                            <span class="badge badge-danger">پرداخت نشده</span>
                            @else
                                <span class="badge badge-success">پرداخت شده</span>
                            @endif
                        </div>
                        <div class="col col-auto">
                            <a class="mb-0">شناسه : #{{ $invoice->id }}</a>
                        </div>
                    </div>
                </div>
                <div class="list-id">
                    <div class="row" style="justify-content: space-evenly;">
                        <div>
                            <a class="mb-0">زمان ساخت: {{ convertToJalaliDate($invoice->created_at, true) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="card-header border-0 mb-1">
                        <h4 class="card-title" style="font-size:2rem;">پرداختی ها</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    @if($payments)
                                        @foreach($payments as $payment)
                                            <tr class="border-bottom">
                                                <td class="d-flex pr-6">
                                                    <a href="{{ route('payments.show', $payment->id) }}" class="d-flex btn payment-td">
                                                        <span class="@if($payment->pay_type == 'cheque') bg-warning warning-border @else bg-primary primary-border @endif brround d-block ml-5 mt-1 h-5 w-5"></span>
                                                        <div class="my-auto d-flex" style="flex-direction: column;align-items: flex-start;">
                                                            <span class="mb-1 font-weight-semibold fs-17">@if($payment->pay_type == 'cheque') چک @else نقدی @endif
                                                            <span style="color:#00cf00">{{ number_format($payment->amount) }}</span> تومان</span>
                                                            @if($payment->pay_type == 'cheque')
                                                                <div class="clearfix"></div>
                                                                <small class="fs-14">زمان سررسید چک: {{ convertToJalaliDate($payment->due_date, true) }}</small>
                                                            @endif
                                                            <div class="clearfix"></div>
                                                            <small class="text-muted fs-14">{{ $payment->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td><span style="color:red;">هیچ پرداختی وجود ندارد</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- End Row -->



<div style="margin-bottom:25px;position: relative;bottom: 100px;">
    <button class="btn btn-info" onclick="printDiv('yourDivId')"><i class="si si-printer"></i> Print Invoice</button>
</div>

<div class="row" style="position: relative;bottom: 100px;">
    <div class="col-md-12">
        <div class="card overflow-hidden">
            <div class="card-body">
                <a class="header-brand" style="margin:auto;display: flex;flex-direction: column;align-items: center;margin-top:25px;">
                    <img src="{{ asset('assets/images/hospital_logo.png') }}" class="header-brand-image dark-logo" alt="Dayonelogo">
                    <h2 class="text-muted font-weight-bold" style="margin:0;">صورت حساب</h2>
                    <h2 class="text-muted font-weight-bold" style="margin:0;">بیمارستان</h2>
                </a>
                <div class="d-flex" style="flex-direction: column;">
                    <h5 class="mb-1">شماره شناسه: <strong>{{ $invoice->id }}</strong></h5>
                    <span>تاریخ ثبت صورت حساب: <strong>{{ convertToJalaliDate($invoice->created_at, true) }}</strong></span>
                    <span>مدیر حساب داری بیمارستان - <strong>{{ Auth::user()->name }}</strong></span>
                </div>

                <div class="card-body pl-0 pr-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="text-muted">محل امضا مسئول</span>
                        </div>
                        <div class="col-sm-6 text-left">
                            <span class="text-muted">محل امضا دکتر</span>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive push">
                    <h2 class="text-muted font-weight-bold">عمل ها</h2>
                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
						<thead>
							<tr>
								<th class="border-bottom-0">ردیف</th>
								<th class="border-bottom-0">نام</th>
								<th class="border-bottom-0">قیمت</th>
								<th class="border-bottom-0">وضعیت</th>
								<th class="border-bottom-0">اقدامات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($operations as $data)

								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $data->name }}</td>
									<td class="comma">{{ $data->price }}</td>
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
											<a href="{{ route('operations.edit', $data->id) }}" class="action-btns1">
												<i class="feather feather-edit-2  text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="ویرایش"></i>
											</a>
											<a href="#" data-id="{{ $data->id }}" class="action-btns1 role-operation" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">
												<i class="feather feather-trash-2 text-danger"></i>
											</a>
										</div>
									</td>
								</tr>

							@endforeach
						</tbody>
					</table>
                </div>
                <p class="text-muted text-center">از اینکه با ما همکاری کردید بسیار سپاسگزاریم. ما مشتاقانه منتظر همکاری مجدد با شما هستیم!</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/progress-bar.js') }}"></script>

	<script src="{{ asset('assets/js/print.js') }}"></script>
    
		<script src="{{ asset('assets/js/view-page.js') }}"></script>
@endsection
