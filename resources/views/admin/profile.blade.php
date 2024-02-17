@extends('layouts.admin.master')
@section('title', 'پروفایل')
@section('content')
<!-- Row -->
<div class="row">
    <div class="col-xl-9 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update', $user->id) }}" id="user" name="user" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="form-label">نام و نام خانوادگی</label>
                                    <input class="form-control" value="{{ $user->name }}" placeholder="عنوان" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="form-label">شماره موبایل</label>
                                    <input class="form-control" value="{{ $user->mobile }}" type="number" placeholder="شماره موبایل" name="mobile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="form-label">ایمیل</label>
                                    <input class="form-control" value="{{ $user->email }}" type="email" placeholder="ایمیل" name="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <a onclick="window.history.back();" class="btn btn-danger btn-lg">برگشت</a>
                        <button type="submit" class="btn btn-success btn-lg">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">مقام</h4>
            </div>
            <div class="card-body text-center">
                <?php 
                    $userRole = Spatie\Permission\Models\Role::where('name', Auth::User()->getRoleNames()[0])->select('name', 'label')->first();
                    $profile = 'assets/images/' . $userRole->name . '.png'; 
                ?>
                <img src="{{ asset($profile) }}" class="avatar avatar-xxl brround" alt="">
                <h4 class="h4 mb-0 mt-3 font-weight-bold">{{ $userRole->label }}</h4>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
	<script src="{{ asset('assets/js/publishFormBtn.js') }}"></script>
@endsection