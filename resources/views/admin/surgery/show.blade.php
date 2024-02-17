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
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">اطلاعات بیمار</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><span class="font-weight-semibold">نام و نام خانوداگی :</span> {{ $surgery->patient_name }}</td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">کد ملی :</span> {{ $surgery->patient_national_code }}</td>
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
                                {!! $surgery->description !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">دکتر و نقش ها</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                @foreach($doctors as $doctor)
                                    <?php $doctorRoles = $doctor->doctorRoles; ?>
                                    @foreach($doctorRoles as $doctorRole)
                                    <tr>
                                        <td><span class="font-weight-bold">نقش {{ $doctorRole->title }}</td>
                                    @endforeach
                                        <td><span class="font-weight-semibold">دکتر : <a href="{{ route('doctors.show', $doctor->id) }}">{{ $doctor->name }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="list-id mb-2">
                    <div class="row" style="justify-content: center;">
                        <div class="col col-auto">
                            <a class="mb-0">شماره سند : {{ $surgery->document_number }}</a>
                        </div>
                        <div class="col col-auto">
                            <a class="mb-0">شناسه : #{{ $surgery->id }}</a>
                        </div>
                    </div>
                </div>
                <div class="list-id">
                    <div class="row" style="justify-content: space-evenly;">
                        <div>
                            <a class="mb-0">زمان ساخت: {{ convertToJalaliDate($surgery->created_at, true) }}</a>
                        </div>
                        <div>
                            <a class="mb-0">زمان جراحی: {{ convertToJalaliDate($surgery->surgeried_at, true) }}</a>
                        </div>
                        <div>
                            <a class="mb-0">زمان مرخصی: {{ convertToJalaliDate($surgery->released_at, true) }}</a>
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
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">عمل ها</h3>
                    </div>
                    <div class="table-responsive">
                        @foreach($operations as $operation)
                            <table class="table row table-borderless w-100 m-0 text-nowrap">
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                    <tr>
                                        <td><span class="font-weight-semibold">عمل :</span> {{ $operation['name'] }}</td>
                                        <td><span class="font-weight-semibold">قيمت :</span> {{ $operation['price'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                        @if($insurance != null)
                            <hr>
                            <table class="table row table-borderless w-100 m-0 text-nowrap">
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><span class="font-weight-semibold">قیمت كل :</span> {{ $ultimatePrice }} تومان</td>
                                        </tr>
                                        <tr>
                                            <td><span class="font-weight-semibold">تخفیف :</span> {{ $discountedPriceFromOriginal }} <span style="color:red;">({{ $insurance->discount }}%)</span> تومان</td>
                                        </tr>
                                        <tr>
                                            <td><span class="font-weight-semibold">جمع :</span> {{ $discountedPrice }} تومان</td>
                                        </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            @if($insurance != null)
                <div class="card-body">
                    <div class="mb-4">
                        <div class="mb-1">
                            <h3 style="font-size:2rem;">بیمه</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table row table-borderless w-100 m-0 text-nowrap">
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                    <tr>
                                        <td><span class="font-weight-semibold">نام :</span> {{ $insurance->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="font-weight-semibold">نوع :</span> {{ $insuranceType }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="font-weight-semibold">تخفیف :</span> {{ $insurance->discount }}%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
		<script src="{{ asset('assets/js/view-page.js') }}"></script>
@endsection
