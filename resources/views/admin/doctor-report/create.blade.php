@extends('layouts.admin.master')
@section('title', '')
@section('links')
	<link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Row -->
<div style="margin-bottom: -50px;position: relative;bottom: 70px;">
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
                                <th class="border-bottom-0">عمل ها</th>
                                <th class="border-bottom-0">مبلغ کل (به تومان)</th>
                                <th class="border-bottom-0">بیمه</th>
                                <th class="border-bottom-0">توضیحات</th>
                                <th class="border-bottom-0">تاریخ جراحی</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surgeries as $data)
                                <tr>
                                    @php
                                        $rowNumber = ($doctorSurgery->currentPage() - 1) * $doctorSurgery->perPage() + $loop->iteration;
                                    @endphp
                                    <td>{{ $rowNumber }}</td>
                                    <td>{{ $data->patient_name }}</td>
                                    <td style="width:10px;">
                                        @php
                                            $names = [];
                                            foreach($data->operations as $operation) {
                                                $names[] = $operation->name;
                                            }
                                            echo implode(' - ', $names);
                                        @endphp
                                    </td>
                                    <td>{{ number_format($data->getTotalPrice()) }} تومان</td>
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
                                    @if($data->description != null)
										<td>
											<a href="#" class="btn btn-warning" onclick="openDescriptionModal('{{ $data->id }}', 'doctor-reports')"
											data-toggle="modal" data-target="#descriptionmodal">
												<span>تماشا</span>
											</a>
										</td>
									@else
                                        <td style="color:red;">هیچ توضیحی وجود ندارن</td>
									@endif
                                    <td>{{ convertToJalaliDate($data->surgeried_at, true) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <td>جمع کل</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($totalPrice) }} تومان</td>
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


<!--Show description modal -->
<div class="modal fade" id="descriptionmodal">
	<div class="modal-dialog" role="document">
		<x-errors></x-errors>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">توضیحات جراحی</h5>
				<button  class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
			<div class="form-group" id="description_body"></div>
			<div class="modal-footer">
				<a href="#" class="btn btn-outline-primary" data-dismiss="modal">بستن</a>
			</div>
		</div>
	</div>
</div>
<!-- End Change description modal  -->

@endsection
@section('scripts')
	<script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

	<script src="{{ asset('assets/js/open-description.js') }}"></script>

	<script src="{{ asset('assets/js/select-all.js') }}"></script>
@endsection