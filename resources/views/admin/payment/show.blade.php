@extends('layouts.admin.master')
@section('title', 'پرداختی')
@section('content')
<!-- Row -->
<div class="row">
    <div class="@if($payment->receipt != null) col-xl-8 @else col-xl-12 @endif col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">اطلاعات پرداخت</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><span class="font-weight-semibold">مبلغ :</span> 
                                    <span class="comma" style="color:#11e311">{{ $payment->amount }}</span> تومان از <span class="comma text-muted">{{ $invoice->amount }}</span> تومان</td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">نوع پرداخت :</span> {{ $payment->pay_type === 'cash' ? 'نقد' : 'چک' }}</td>
                                </tr>
                                @if($payment->due_date != null)
                                    <tr>
                                        <td><span class="font-weight-semibold">زمان سررسید چک :</span> {{ convertToJalaliDate($payment->created_at, true) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><span class="font-weight-semibold">توضیحات :</span> {!! $payment->description !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="list-id mb-2">
                    <div class="row" style="justify-content: center;">
                        <div class="col col-auto">
                            <a class="mb-0">شناسه : #{{ $payment->id }}</a>
                        </div>
                        <div class="col col-auto">
                            @if ($payment->status == '1')
                                <a class="mb-0" style="color:lime">وضعیت : پرداخت شده</a>
                            @else
                                <a class="mb-0" style="color:red">وضعیت : پرداخت نشده</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="list-id">
                    <div class="row" style="justify-content: space-evenly;">
                        <div>
                            <a class="mb-0">زمان پرداخت شده: {{ convertToJalaliDate($payment->created_at, true) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($payment->receipt != null)
        <div class="col-xl-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>تصویر رسید</h1>
                    <img src="{{ asset('storage/payment/'.$payment->receipt) }}" class="img-fluid d-block rounded" style="max-height:332px;" alt="Banner Image">
                </div>
            </div>
        </div>
    @endif

    <div class="col-xl-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">صورت حساب این پرداختی</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><span class="font-weight-semibold">مبلغ کل عمل ها :</span> <span class="comma" style="color:#11e311">{{ $invoice->amount }}</span> تومان</td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">توضیحات :</span> {!! $invoice->description !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="list-id mb-2">
                        <div class="row" style="justify-content: center;">
                            <div class="col col-auto">
                                <a class="mb-0">شناسه صورت حساب : #{{ $invoice->id }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="list-id">
                        <div class="row" style="justify-content: space-evenly;">
                            <div>
                                <a class="mb-0">زمان ساخت صورت حساب: {{ convertToJalaliDate($invoice->created_at, true) }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">اطلاعات دکتر</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><span class="font-weight-semibold">نام و نام خانوادگی دکتر :</span> <a href="{{ route('doctors.show', $doctor->id) }}" class="badge badge-primary">{{ $doctor->name }}</a></td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">نقش دکتر در این عمل :</span> {{ $doctorRole->title }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="list-id mb-2">
                        <div class="row" style="justify-content: center;">
                            <div class="col col-auto">
                                <a class="mb-0">شناسه دکتر : #{{ $doctor->id }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/view-page.js') }}"></script>

    <script src="{{ asset('assets/js/comma.js') }}"></script>
@endsection
