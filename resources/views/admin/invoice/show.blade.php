@extends('layouts.admin.master')
@section('title', 'جراحی')
@section('content')
<a href="{{ route('surgeries.create') }}"><button class="btn btn-primary news-btn">جراحی جدید +</button></a>
<!-- Row -->
<div class="row">
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
                                                        <span class="bg-green green-border brround d-block ml-5 mt-1 h-5 w-5"></span>
                                                        <div class="my-auto">
                                                            <span class="mb-1 font-weight-semibold fs-17">@if($payment->pay_type == 'cheque')چک @endif
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
</div>
<!-- End Row -->
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/progress-bar.js') }}"></script>
    
		<script src="{{ asset('assets/js/view-page.js') }}"></script>
@endsection
