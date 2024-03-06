@extends('layouts.admin.master')
@section('title', 'جراحی')
@section('content')
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <div class="mb-1">
                        <h3 style="font-size:2rem;">اعلان</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table row table-borderless w-100 m-0 text-nowrap">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><span class="font-weight-semibold">عنوان :</span> {{ $notification->title }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($notification->body != null)
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="mb-1">
                                <h3 style="font-size:2rem;">توضیحات</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table row table-borderless w-100 m-0 text-nowrap">
                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                        {!! $notification->body !!}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="list-id mb-2">
                    <div class="row" style="justify-content: center;">
                        <div class="col col-auto">
                            <a class="mb-0">شناسه : #{{ $notification->id }}</a>
                        </div>
                    </div>
                </div>
                <div class="list-id">
                    <div class="row" style="justify-content: space-evenly;">
                        <div>
                            <a class="mb-0">زمان ساخت: {{ convertToJalaliDate($notification->created_at, true) }}</a>
                        </div>
                        @php
                            $viewedAt = ($notification->viewed_at != null) ? $notification->viewed_at : 'هنوز بازدید نشده';
                        @endphp
                        <div>
                            <a class="mb-0">زمان بازدید: @if($viewedAt != 'هنوز بازدید نشده'){{ convertToJalaliDate($viewedAt, true) }}@else {{ $viewedAt }} @endif</a>
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
@endsection
