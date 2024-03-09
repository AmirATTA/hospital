@extends('layouts.admin.master')
@section('title', 'داشبورد')
@section('links')
    <!-- INTERNAL Morris Charts css -->
    <link href="{{ asset('assets/plugins/morris/morris.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div class="row">

    @php $user = auth()->user(); @endphp

    @if($user->can('view payments') || $user->can('view activity-logs'))
        <div class="col-xl-9 col-md-12 col-lg-12">
    @else
        <div class="col-xl-12 col-md-12 col-lg-12">
    @endif
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="card" style="height: 160px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-0 text-right"> <span class="fs-14 font-weight-semibold">جمع دکتر ها</span>
                                    <h3 class="mb-0 mt-1 mb-2">{{ $doctorSum }}</h3>
                                    <span class="text-muted">
                                        <span class="text-success fs-12 mt-2 ml-1"><i class="feather feather-arrow-up-right ml-1 bg-success-transparent p-1 brround"></i>{{ $latestDoctor->created_at->diffForHumans() }}</span>
                                        جدید ترین دکتر
                                    </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="icon1 bg-success-transparent my-auto  float-left"> <i class="feather feather-users" style="margin-top: 13px;"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="card" style="height: 160px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-0 text-right"> <span class="fs-14 font-weight-semibold">تعداد مدیران</span>
                                    <h3 class="mb-0 mt-1 mb-2">{{ $userSum }}</h3>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="icon1 bg-primary-transparent my-auto  float-left"> <i class="fa-solid fa-user-tie" style="margin-top: 13px;"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="card" style="height: 160px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-0 text-right"> <span class="fs-14 font-weight-semibold">مخارج</span>
                                <h3 class="mb-0 mt-1  mb-2">{{ number_format($invoiceSum) }} تومان</h3> </div>
                            </div>
                            <div class="col-4">
                                <div class="icon1 bg-secondary-transparent brround my-auto  float-left"> <i class="feather feather-dollar-sign" style="margin-top: 13px;"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <div class="card-title">درآمد (تا 10 جراحی قبل)</div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-wrapper-demo">
                            <div id="chart" class="h-300 mh-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-12 col-lg-12">
        <div class="card overflow-hidden">
            @can('view payments')
                <div class="card-header border-0">
                    <h4 class="card-title">آخرین پرداختی ها</h4>
                </div>
                <div class="pt-6">
                    <div class="list-group">
                        @foreach($payments as $payment)
                            <a href="{{ route('payments.show', $payment->id) }}">
                                <div class="list-group-item d-flex pt-3 pb-3 align-items-center border-0">
                                    <div class="ml-3 ml-xs-0">
                                        @if($payment->pay_type == 'cash')
                                            <i class="fa-solid fa-money-bills bg-success-transparent" style="font-size:2rem; margin:5px;"></i>
                                        @else
                                            <i class="fa-solid fa-money-check-dollar bg-warning-transparent" style="font-size:2rem; margin:5px;"></i>
                                        @endif
                                    </div>
                                    <div class="ml-1">
                                        <div class="fs-14 mb-1" style="font-size:1.1rem;">{{ number_format($payment->amount) }}
                                        تومان @php if($payment->pay_type == 'cash'){echo 'نقد';}else{echo 'چک';} @endphp</div>
                                        <small class="text-muted">برای دکتر {{ $doctorName[0] }}</small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        @if($payments->count() == 0)
                            <div style="margin-right:60px;color:red;transform:translateY(-20px);">هیچ پرداختی وجود ندارد!</div>
                        @endif
                    </div>
                </div>
            @endcan
            @can('view activity-logs')
            <div class="mb-4">
                <div class="card-header border-bottom-0 pt-2 pl-0">
                    <h4 class="card-title">گزارش فعالیت های اخیر</h4>
                </div>
                <ul class="vertical-scroll" style="overflow-y: hidden;">
                    @foreach($activityLogs as $log)
                        <li style="" class="item">
                            <a href="{{ route('activity-logs.show', $log->id) }}" class="item-show">
                                <div class="card p-1">
                                    <div class="d-flex comming_events icons" style="align-items: center;">
                                        <span class="bg-{{ ['success', 'warning', 'danger', 'primary'][rand(0, 3)] }} bradius ml-3 d-flex" style="text-align:center;padding:2px;font-size: .9rem;width: 70px;height: 70px;align-items: center;justify-content: center;">
                                            {{ __('custom.'. $log->subject_type) }}
                                        </span>
                                        <div class="mr-3 mt-0 mt-sm-1 d-block">
                                            <h6 class="mb-1">{{ $log->description }}</h6>
                                            <span class="clearfix"></span>
                                            <small>انجام شده توسط {{ App\Models\User::where('id', $log->causer_id)->pluck('name')[0] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endcan
        </div>
    </div>
</div>

<!-- End Row -->
@endsection
<script>
    var chartAmount = JSON.parse('{!! $amount !!}');
    var chartDate = {!! $date !!};
    
</script>
@section('scripts')
    <!--Othercharts js-->
    <script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Circle-progress js-->
    <script src="{{ asset('assets/plugins/circle-progress/circle-progress.min.js') }}"></script>

    <!-- INTERNAL Chart js -->
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/apexchart-custom.js') }}"></script>
@endsection
