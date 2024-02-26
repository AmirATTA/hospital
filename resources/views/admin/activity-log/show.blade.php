@extends('layouts.admin.master')
@section('title', 'گزارش فعالیت')
@section('content')
<!-- Row -->
<style>
    .user-info {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 20px;
        max-width: 400px;
        font-family: Arial, sans-serif;
    }
    .user-info h2 {
        color: #333;
    }
    .user-info p {
        margin: 5px 0;
    }
</style>
<div class="row">
    <div class="col-xl-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">اطلاعات گزارش</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><span class="font-weight-semibold">توضیح :</span> {{ $activityLog->description }}</td>
                                </tr>
                                <tr>
                                    <td><span class="font-weight-semibold">شناسه موضوع :</span> {{ $activityLog->subject_id }}</td>
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
                            <a class="mb-0">شماره سند : {{ $activityLog->id }}</a>
                        </div>
                    </div>
                </div>
                <div class="list-id">
                    <div class="row" style="justify-content: space-evenly;">
                        <div>
                            <a class="mb-0">زمان ساخت: {{ convertToJalaliDate($activityLog->created_at, true) }}</a>
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
                        <h3 style="font-size:2rem;">ویژگی ها</h3>
                    </div>
                    <ul>
                        @foreach($userAttributes['attributes'] as $key => $value)
                            @if($key !== 'password')
                                <li>
                                    <div class="properties-list">
                                        <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}</strong>
                                        <span>
                                            @if($value != null)
                                                {{ $value }}
                                            @else
                                                خالی
                                            @endif
                                        </span>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">توسط</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap" style="display: flex;justify-content: center;">
                            <tbody class="col-lg-12 col-xl-6 p-0 card-body text-center" style="display: flex;justify-content: center;">
                                <tr>
                                    <?php 
                                        $userRole = Spatie\Permission\Models\Role::where('name', $causer->getRoleNames()[0])->select('name', 'label')->first();
                                        $profile = 'assets/images/' . $userRole->name . '.png'; 
                                    ?>
                                    <td style="display: flex;flex-wrap: wrap;justify-content: center;gap:1rem;flex-direction: column;">
                                        <img src="{{ asset($profile) }}" class="avatar avatar-xxl brround" alt="">
                                        {{ $causer->name }}
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
<!-- End Row -->
@endsection
@section('scripts')
		<script src="{{ asset('assets/js/view-page.js') }}"></script>
@endsection
