@extends('layouts.admin.master')
@section('title', 'داشبورد')
@section('links')
    <!-- INTERNAL Morris Charts css -->
    <link href="{{ asset('assets/plugins/morris/morris.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div class="row">
    <div class="col-xl-9 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-0 text-right"> <span class="fs-14 font-weight-semibold">جمع دکتر ها</span>
                                    <h3 class="mb-0 mt-1 mb-2">6,578</h3>
                                    <span class="text-muted">
                                        <span class="text-success fs-12 mt-2 ml-1"><i class="feather feather-arrow-up-right ml-1 bg-success-transparent p-1 brround"></i>2 روز پیش</span>
                                        جدید ترین دکتر
                                    </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="icon1 bg-success-transparent my-auto  float-left"> <i class="feather feather-users"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-0 text-right"> <span class="fs-14 font-weight-semibold">تعداد مدیران</span>
                                    <h3 class="mb-0 mt-1 mb-2">124</h3>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="icon1 bg-primary-transparent my-auto  float-left"> <i class="fa-solid fa-user-tie"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mt-0 text-right"> <span class="fs-14 font-weight-semibold">مخارج</span>
                                <h3 class="mb-0 mt-1  mb-2">$2,7853</h3> </div>
                            </div>
                            <div class="col-4">
                                <div class="icon1 bg-secondary-transparent brround my-auto  float-left"> <i class="feather feather-dollar-sign"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <div class="card-title">درآمد</div>
                    </div>
                    <div class="card-body">
                        <div id="surgery_amount">25000000, 1000000, 2400000, 6250000</div>
                        <div id="date_times">"2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z"</div>
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
            <div class="card-header border-0">
                <h4 class="card-title">سررسید چک</h4>
            </div>
            <div class="pt-2">
                <div class="list-group">
                    <div class="list-group-item d-flex pt-3 pb-3 align-items-center border-0">
                        <div class="ml-3 ml-xs-0">
                            <div class="calendar-icon icons">
                                <div class="date_time bg-pink-transparent"> <span class="date">18</span> <span class="month">FEB</span> </div>
                            </div>
                        </div>
                        <div class="ml-1">
                            <div class="h5 fs-14 mb-1">Board meeting Completed</div> <small class="text-muted">attend the  company mangers...</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex pt-3 pb-3 align-items-center border-0">
                        <div class="ml-3 ml-xs-0">
                            <div class="calendar-icon icons">
                                <div class="date_time bg-success-transparent "> <span class="date">16</span> <span class="month">FEB</span> </div>
                            </div>
                        </div>
                        <div class="ml-1">
                            <div class="h5 fs-14 mb-1"><span class="font-weight-normal">Updated the Company</span> Policy</div>
                            <small class="text-muted">some changes &amp; add the  terms &amp; conditions </small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex pt-3 pb-3 align-items-center border-0">
                        <div class="ml-3 ml-xs-0">
                            <div class="calendar-icon icons">
                                <div class="date_time bg-orange-transparent "> <span class="date">17</span> <span class="month">FEB</span> </div>
                            </div>
                        </div>
                        <div class="ml-1">
                            <div class="h5 fs-14 mb-1">Office Timings Changed</div> <small class="text-muted"> this effetct  after March 01st 9:00 Am To 5:00 Pm</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex pt-3 pb-5 align-items-center border-0">
                        <div class="ml-3 ml-xs-0">
                            <div class="calendar-icon icons">
                                <div class="date_time bg-info-transparent "> <span class="date">26</span> <span class="month">JAN</span> </div>
                            </div>
                        </div>
                        <div class="ml-1">
                            <div class="h5 fs-15 mb-1"> Republic Day Celebrated </div> <small class="text-muted">participate the all employess </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    </div>
    <div class="col-xl-4 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <h4 class="card-title">Project Overview</h4>
                <div class="card-options">
                    <div class="dropdown"> <a href="#" class="btn btn-outline-light" data-toggle="dropdown" aria-expanded="false"> Week <i class="feather feather-chevron-down"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a href="#">Monthly</a></li>
                            <li><a href="#">Yearly</a></li>
                            <li><a href="#">Weekly</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mt-5"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="sales-summary" class="chartjs-render-monitor" height="250" style="display: block; width: 480px; height: 250px;" width="480"></canvas>
                </div>
                <div class="sales-chart mt-4 row text-center">
                    <div class="d-flex my-auto col-sm-4 mx-auto text-center justify-content-center"><span class="dot-label bg-primary ml-2 my-auto"></span>On progress</div>
                    <div class="d-flex my-auto col-sm-4 mx-auto text-center justify-content-center"><span class="dot-label bg-secondary ml-2 my-auto"></span>Pending</div>
                    <div class="d-flex my-auto col-sm-4 mx-auto text-center justify-content-center"><span class="dot-label bg-light4  ml-2 my-auto"></span>Completed</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <h4 class="card-title">Recent Activity</h4>
                <div class="card-options">
                    <div class="dropdown"> <a href="#" class="btn btn-outline-light" data-toggle="dropdown" aria-expanded="false"> View All <i class="feather feather-chevron-down"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <li><a href="#">Monthly</a></li>
                            <li><a href="#">Yearly</a></li>
                            <li><a href="#">Weekly</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="timeline">
                    <li>
                        <a target="_blank" href="#" class="font-weight-semibold fs-15 mr-3">Leave Approval Request</a>
                        <a href="#" class="text-muted float-left fs-13">6 min ago</a>
                        <p class="mb-0 pb-0 text-muted pt-1 fs-11 mr-3">From "RuthDyer" UiDesign Leave</p>
                        <span class="text-muted  mr-3 fs-11"> On Monday 12 Jan 2020.</span>
                    </li>
                    <li class="primary">
                        <a target="_blank" href="#" class="font-weight-semibold fs-15 mb-2 mr-3">Wok Update</a>
                        <a href="#" class="text-muted float-left fs-13">10 min ago</a>
                        <p class="mb-0 pb-0 text-muted fs-11 pt-1 mr-3">From "Robert Marshall" Developer</p>
                        <span class="text-muted mr-3 fs-11">Task Completed.</span>
                    </li>
                    <li class="pink">
                        <a target="_blank" href="#" class="font-weight-semibold fs-15 mb-2 mr-3">Received Mail</a>
                        <a href="#" class="text-muted float-left fs-13">15 min ago</a>
                        <p class="mb-0 pb-0 text-muted fs-11 pt-1 mr-3">Emergency Sick Leave from "jacob Berry"</p>
                        <span class="text-muted mr-3 fs-11">Ui Designer, Designer Team.</span>
                    </li>
                    <li class="success mb-0 pb-0">
                        <a target="_blank" href="#" class="font-weight-semibold fs-15 mb-2 mr-3">Job Application Mail</a>
                        <a href="#" class="text-muted float-left fs-13">1 Hour ago</a>
                        <p class="mb-0 pb-0 text-muted fs-11 pt-1 mr-3">From jobmail@gmail.com laravel developer.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12 col-lg-12">
        <div class="card chart-donut1">
            <div class="card-header  border-0">
                <h4 class="card-title">Gender by Employees</h4>
            </div>
            <div class="card-body">
                <div id="employees" class="mx-auto apex-dount" style="min-height: 270.537px;"><div id="apexcharts41msa3gs" class="apexcharts-canvas apexcharts41msa3gs light" style="width: 480px; height: 270.537px;"><svg id="SvgjsSvg1043" width="480" height="270.5365853658537" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1045" class="apexcharts-inner apexcharts-graphical" transform="translate(119.5, 0)"><defs id="SvgjsDefs1044"><clipPath id="gridRectMask41msa3gs"><rect id="SvgjsRect1046" width="243" height="265" x="0" y="0" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMask41msa3gs"><rect id="SvgjsRect1047" width="245" height="267" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath></defs><g id="SvgjsG1049" class="apexcharts-pie" data:innerTranslateX="0" data:innerTranslateY="-25"><g id="SvgjsG1050" transform="translate(0, -5) scale(1)"><circle id="SvgjsCircle1051" r="100.21463414634147" cx="121.5" cy="132.5" fill="transparent"></circle><g id="SvgjsG1052" class="apexcharts-slices"><g id="SvgjsG1053" class="apexcharts-series apexcharts-pie-series" seriesName="Male" rel="1" data:realIndex="0"><path id="SvgjsPath1054" d="M 121.50000000000001 7.231707317073159 A 125.26829268292684 125.26829268292684 0 1 1 8.525512617510103 186.61940827798333 L 31.12041009400808 175.79552662238666 A 100.21463414634147 100.21463414634147 0 1 0 121.5 32.28536585365853 L 121.50000000000001 7.231707317073159 z" fill="rgba(51,102,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="244.40366972477065" data:startAngle="0" data:strokeWidth="0" data:value="74" data:pathOrig="M 121.50000000000001 7.231707317073159 A 125.26829268292684 125.26829268292684 0 1 1 8.525512617510103 186.61940827798333 L 31.12041009400808 175.79552662238666 A 100.21463414634147 100.21463414634147 0 1 0 121.5 32.28536585365853 L 121.50000000000001 7.231707317073159 z"></path></g><g id="SvgjsG1055" class="apexcharts-series apexcharts-pie-series" seriesName="Female" rel="2" data:realIndex="1"><path id="SvgjsPath1056" d="M 8.525512617510103 186.61940827798333 A 125.26829268292684 125.26829268292684 0 0 1 121.47813655855428 7.231709225018349 L 121.48250924684343 32.28536738001469 A 100.21463414634147 100.21463414634147 0 0 0 31.12041009400808 175.79552662238666 L 8.525512617510103 186.61940827798333 z" fill="rgba(254,127,0,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="115.59633027522935" data:startAngle="244.40366972477065" data:strokeWidth="0" data:value="35" data:pathOrig="M 8.525512617510103 186.61940827798333 A 125.26829268292684 125.26829268292684 0 0 1 121.47813655855428 7.231709225018349 L 121.48250924684343 32.28536738001469 A 100.21463414634147 100.21463414634147 0 0 0 31.12041009400808 175.79552662238666 L 8.525512617510103 186.61940827798333 z"></path></g></g></g><g id="SvgjsG1057" class="apexcharts-datalabels-group" transform="translate(0, 0)"><text id="SvgjsText1058" font-family="Helvetica, Arial, sans-serif" x="121.5" y="122.5" text-anchor="middle" dominant-baseline="auto" font-size="29px" font-weight="regular" fill="#373d3f" class="apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;">Total</text><text id="SvgjsText1059" font-family="Helvetica, Arial, sans-serif" x="121.5" y="164.5" text-anchor="middle" dominant-baseline="auto" font-size="26px" font-weight="regular" fill="#373d3f" class="apexcharts-datalabel-value" style="font-family: Helvetica, Arial, sans-serif;">109</text></g></g><line id="SvgjsLine1060" x1="0" y1="0" x2="243" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1061" x1="0" y1="0" x2="243" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(51, 102, 255);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(254, 127, 0);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                <div class="sales-chart pt-5 pb-3 d-flex mx-auto text-center justify-content-center ">
                    <div class="d-flex ml-5"><span class="dot-label bg-primary ml-2 my-auto"></span>Male</div>
                    <div class="d-flex"><span class="dot-label bg-secondary  ml-2 my-auto"></span>Female</div>
                </div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 529px; height: 377px;"></div></div><div class="contract-trigger"></div></div></div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-xl-6 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header border-bottom-0">
                <h3 class="card-title">Recent Job Application</h3>
                <div class="card-options">
                    <div class="dropdown"> <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> See All <i class="feather feather-chevron-down"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu" style="">
                            <li><a href="#">Monthly</a></li>
                            <li><a href="#">Yearly</a></li>
                            <li><a href="#">Weekly</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-menu-heading table_tabs mt-2 p-0 ">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="mr-4"><a href="#tab5" data-toggle="tab">Job Applications</a></li>
                        <li><a href="#tab6" class="active" data-toggle="tab">Job Opening</a></li>
                        <li><a href="#tab7" data-toggle="tab">Hired Candidates</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body table_tabs1 p-0 border-0">
                <div class="tab-content">
                    <div class="tab-pane" id="tab5">
                        <div class="table-responsive recent_jobs pt-2 pb-2 pl-2 pr-2 card-body">
                            <table class="table mb-0 text-nowrap">
                                <tbody>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/16.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">Faith Harris</h6>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">UI designer</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">5 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/1.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">James Paige</h6>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">UI designer</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">2 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>India</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/4.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">Liam Miller</h6>
                                                    <div class="clearfix"></div>
                                                    <small>WireFrameing</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">1 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>Germany</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/8.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">Kimberly Berry</h6>
                                                    <div class="clearfix"></div>
                                                    <small>Senior Prototyper</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">3 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/9.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">Kimberly Berry</h6>
                                                    <div class="clearfix"></div>
                                                    <small>Senior Prototyper</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">3 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab6">
                        <div class="table-responsive recent_jobs pt-2 pb-2 pl-2 pr-2 card-body">
                            <table class="table mb-0 text-nowrap">
                                <tbody>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <div class="table_img brround bg-light ml-3">
                                                    <span class="bg-light brround fs-12">UI/UX</span>
                                                </div>
                                                <div class="ml-3 mt-3 d-block">
                                                    <h6 class="mb-0 fs-13 font-weight-semibold">UI UX Designers</h6>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">12 Dec 2020</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">4 vacancies</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <div class="table_img brround bg-light ml-3">
                                                    <img src="../../assets/images/photos/html.png" alt="img" class=" bg-light brround">
                                                </div>
                                                <div class="ml-3 mt-3 d-block">
                                                    <h6 class="mb-0 fs-13 font-weight-semibold">Experienced Html Developer</h6>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">28 Nov 2020</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">2 vacancies</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <div class="table_img brround bg-light ml-3">
                                                    <img src="../../assets/images/photos/jquery.png" alt="img" class=" bg-light brround">
                                                </div>
                                                <div class="ml-3 mt-3 d-block">
                                                    <h6 class="mb-0 fs-13 font-weight-semibold">Experienced Jquery Developer</h6>
                                                    <div class="clearfix"></div>
                                                    <small>12 Nov 2020</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">1 vacancies</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <div class="table_img brround bg-light ml-3">
                                                    <img src="../../assets/images/photos/vue.png" alt="img" class=" bg-light brround">
                                                </div>
                                                <div class="ml-3 mt-3 d-block">
                                                    <h6 class="mb-0 fs-13 font-weight-semibold">Vue js Developer</h6>
                                                    <div class="clearfix"></div>
                                                    <small>24 Oct 2020</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">6 vacancies</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="table_img brround bg-light ml-3">
                                                    <img src="../../assets/images/photos/html.png" alt="img" class=" bg-light brround">
                                                </div>
                                                <div class="ml-3 mt-3 d-block">
                                                    <h6 class="mb-0 fs-13 font-weight-semibold">Kimberly Berry</h6>
                                                    <div class="clearfix"></div>
                                                    <small>14 Oct 2020</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">4 vacancies</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                            <a href="#" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab7">
                        <div class="table-responsive recent_jobs pt-2 pb-2 pl-2 pr-2 card-body">
                            <table class="table mb-0 text-nowrap">
                                <tbody>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/16.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">Faith Harris</h6>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">UI designer</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">5 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/1.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">James Paige</h6>
                                                    <div class="clearfix"></div>
                                                    <small class="text-muted">UI designer</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">2 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>India</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/4.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">Liam Miller</h6>
                                                    <div class="clearfix"></div>
                                                    <small>WireFrameing</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">1 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>Germany</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/8.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">Kimberly Berry</h6>
                                                    <div class="clearfix"></div>
                                                    <small>Senior Prototyper</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">3 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img src="../../assets/images/users/9.jpg" alt="img" class="avatar avatar-md brround ml-3">
                                                <div class="mr-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-0">Kimberly Berry</h6>
                                                    <div class="clearfix"></div>
                                                    <small>Senior Prototyper</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left fs-13">3 years</td>
                                        <td class="text-left fs-13"><i class="feather feather-map-pin text-muted mr-2"></i>USA</td>
                                        <td class="text-right">
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                            <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Attendance</h3>
                <div class="card-options ">
                    <a href="#" class="btn btn-outline-light ml-3">View All</a>
                    <div class="dropdown"> <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Date <i class="feather feather-chevron-down"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu" style="">
                            <li><a href="#">Monthly</a></li>
                            <li><a href="#">Yearly</a></li>
                            <li><a href="#">Weekly</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive attendance_table mt-4 border-top">
                <table class="table mb-0 text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">S.No</th>
                            <th class="text-left">Employee</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">CheckIn</th>
                            <th class="text-center">CheckOut</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom">
                            <td class="text-center"><span class="avatar avatar-sm brround">1</span></td>
                            <td class="font-weight-semibold fs-14">Diane Nolan</td>
                            <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                            <td class="text-center">09:30 Am</td>
                            <td class="text-center">06:30 Pm</td>
                            <td class="text-center">
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"><i class="feather-message-circle  text-success"></i></a>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-center"><span class="avatar avatar-sm brround">2</span></td>
                            <td class="font-weight-semibold fs-14">Deirdre Russell</td>
                            <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                            <td class="text-center">09:45 Am</td>
                            <td class="text-center">06:30 Pm</td>
                            <td class="text-center">
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"><i class="feather-message-circle  text-success"></i></a>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-center"><span class="avatar avatar-sm brround">3</span></td>
                            <td class="font-weight-semibold fs-14">Joanne Hills</td>
                            <td class="text-center"><span class="badge bg-danger-transparent">Absent</span></td>
                            <td class="text-center">00:00:00</td>
                            <td class="text-center">00:00:00</td>
                            <td class="text-center">
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"><i class="feather-message-circle  text-success"></i></a>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-center"><span class="avatar avatar-sm brround">4</span></td>
                            <td class="font-weight-semibold fs-14">Luke Ince</td>
                            <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                            <td class="text-center">09:30 Am</td>
                            <td class="text-center">05:15 Pm</td>
                            <td class="text-center">
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"><i class="feather-message-circle  text-success"></i></a>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-center"><span class="avatar avatar-sm brround">5</span></td>
                            <td class="font-weight-semibold fs-14">Grace Mackay</td>
                            <td class="text-center"><span class="badge bg-danger-transparent">Absent</span></td>
                            <td class="text-center">00:00:00</td>
                            <td class="text-center">00:00:00</td>
                            <td class="text-center">
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"><i class="feather-message-circle  text-success"></i></a>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-center"><span class="avatar avatar-sm brround">6</span></td>
                            <td class="font-weight-semibold fs-14">Wanda Quinn</td>
                            <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                            <td class="text-center">09:30 Am</td>
                            <td class="text-center">06:30 Pm</td>
                            <td class="text-center">
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"><i class="feather-message-circle  text-success"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"><span class="avatar avatar-sm brround">7</span></td>
                            <td class="font-weight-semibold fs-14">Liam</td>
                            <td class="text-center"><span class="badge bg-success-transparent">Present</span></td>
                            <td class="text-center">09:30 Am</td>
                            <td class="text-center">06:30 Pm</td>
                            <td class="text-center">
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat"><i class="feather-message-circle  text-success"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection

@section('scripts')
    <!--Othercharts js-->
    <script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Circle-progress js-->
    <script src="{{ asset('assets/plugins/circle-progress/circle-progress.min.js') }}"></script>

    <!-- INTERNAL Chart js -->
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/apexchart-custom.js') }}"></script>
@endsection
