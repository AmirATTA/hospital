@extends('layouts.admin.master')
@section('title', 'دکتر')
@section('content')
<a href="{{ route('doctors.create') }}"><button class="btn btn-primary news-btn">دکتر جدید +</button></a>
<!-- Row -->
<div class="row">
    <div class="col-xl-8 col-md-12">
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
                                    <td><span class="font-weight-semibold">نام و نام خانوداگی :</span> {{ $doctor->name }}</td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">کد ملی :</span> {{ $doctor->national_code }}</td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">شماره نظام پزشکی :</span> {{ $doctor->medical_number }}</td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">شماره موبایل :</span> {{ $doctor->mobile }}</td>
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
                            <a class="mb-0">شناسه : #{{ $doctor->id }}</a>
                        </div>
                    </div>
                </div>
                <div class="list-id">
                    <div class="row" style="justify-content: space-evenly;">
                        <div>
                            <a class="mb-0">زمان ساخت حساب: {{ convertToJalaliDate($doctor->created_at, true) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">تخصص</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><span class="font-weight-semibold">تخصص :</span> {{ $speciality->title }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">نقش ها</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                @foreach($doctorRoles as $doctorRole)
                                    <tr>
                                        <td><span class="font-weight-bold">نقش {{ $doctorRole->title }}</td>
                                    </tr>
                                @endforeach
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
		<script src="{{ asset('assets/js/view-page.js') }}"></script>
@endsection
