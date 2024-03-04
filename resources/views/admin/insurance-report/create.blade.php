@extends('layouts.admin.master')
@section('title', '')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div style="margin-bottom:25px;position: relative;bottom: 100px;">
    <button class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="job-list">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">شناسه</th>
                                <th class="border-bottom-0">نام بیمار</th>
                                <th class="border-bottom-0">کد ملی بیمار</th>
                                <th class="border-bottom-0">عمل ها</th>
                                <th class="border-bottom-0">مبلغ کل (به تومان)</th>
                                <th class="border-bottom-0">سهم بیمه (به تومان)</th>
                                <th class="border-bottom-0">تاریخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surgeries as $data)
                                <tr>
                                    @php
                                        $rowNumber = ($surgeries->currentPage() - 1) * $surgeries->perPage() + $loop->iteration;
                                    @endphp
                                    <td>{{ $rowNumber }}</td>
                                    <td>{{ $data->patient_name }}</td>
                                    <td>{{ $data->patient_national_code }}</td>
                                    <td>
                                        @php
                                            $names = [];
                                            foreach($data->operations as $operation) {
                                                $names[] = $operation->name;
                                            }
                                            echo implode(' - ', $names);
                                        @endphp
                                    </td>
                                    <td>{{ number_format($data->getTotalPrice()) }} تومان</td>
                                    <td class="insurance-amount">{{ $data->getTotalPrice() . ', ' . $insurance->discount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <td>جمع کل</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($totalPrice) }} تومان</td>
                        <td id="insurances_sum">{{ $totalPrice . ', ' . $insurance->discount }}</td>
                    </table>
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

	<script src="{{ asset('assets/js/insurance-report.js') }}"></script>
@endsection