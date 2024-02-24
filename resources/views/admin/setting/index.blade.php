@extends('layouts.admin.master')
@section('title', 'تنظیمات')
@section('content')
<!-- Row -->
<div class="row">
    <div class="card" style="width: 300px;">
        <div class="card text-center" style="background:#316bf3;margin-bottom: 0;">
            <div class="card-body" style="color: white;">
                <h5 class="card-title"><i class="fa-solid fa-location-dot"></i></h5>
                <h5 class="card-title" style="font-family: unset;">تنظیمات عمومی</h5>
                <a class="btn btn-primary" href="{{ route('settings.edit', 'general') }}">ویرایش</a>
            </div>
        </div>
    </div>
    <div class="card mr-5" style="width: 300px;">
        <div class="card text-center" style="background:#3da0d1;margin-bottom: 0;">
            <div class="card-body" style="color: white;">
                <h5 class="card-title"><i class="fa-solid fa-share-nodes"></i></h5>
                <h5 class="card-title" style="font-family: unset;">تنظیمات مجازی</h5>
                <a class="btn btn-primary" href="{{ route('settings.edit', 'social') }}">ویرایش</a>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection