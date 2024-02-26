<!--app header-->
<div class="app-header header">
	<div class="container-fluid">
		<div class="d-flex">
			<a class="header-brand" href="{{ route('dashboard.index') }}">
				<img src="{{ asset('assets/images/hospital_logo.png') }}" class="header-brand-img dark-logo" alt="Dayonelogo">
			</a>
			<div class="app-sidebar__toggle" data-toggle="sidebar">
				<a class="open-toggle" href="#">
					<i class="feather feather-menu"></i>
				</a>
				<a class="close-toggle" href="#">
					<i class="feather feather-x"></i>
				</a>
			</div>
			<div class="d-flex order-lg-2 my-auto mr-auto">
                <div class="dropdown header-fullscreen">
                    <a class="nav-link icon full-screen-link">
                        <i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
						<i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
					</a>
				</div>
                <div class="dropdown header-notify">
                    <a class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
                        <i class="feather feather-bell header-icon"></i>
                        <span class="bg-dot"></span>
                    </a>
                </div>
				<div class="dropdown profile-dropdown">
					<a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
						<span>
							<?php 
								$profile = 'assets/images/' . Auth::User()->getRoleNames()[0] . '.png'; 
							?>
							<img src="{{ asset($profile) }}" alt="img" class="avatar avatar-md bradius">
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow animated">
						<div class="p-3 text-center border-bottom">
							<span class="text-center user pb-0 font-weight-bold">{{ Auth::User()->name }}</span>

							<?php
								$roleLabel = Spatie\Permission\Models\Role::where('name', Auth::User()->getRoleNames())->first();
							?>
							<p class="text-center user-semi-title">{{ $roleLabel->label }}</p>

						</div>
						<a class="dropdown-item d-flex" href="{{ route('profile.edit', Auth::id()) }}">
							<i class="feather feather-user ml-3 fs-16 my-auto"></i>
							<div class="mt-1">پروفایل</div>
						</a>
						<a class="dropdown-item d-flex" href="{{ route('settings.index') }}">
							<i class="feather feather-settings ml-3 fs-16 my-auto"></i>
							<div class="mt-1">تنظیمات</div>
						</a>
						<a class="dropdown-item d-flex" id="change_password" href="#" data-toggle="modal" data-target="#changepasswordnmodal">
							<i class="feather feather-edit-2 ml-3 fs-16 my-auto"></i>
							<div class="mt-1">تغییر گذرواژه</div>
						</a>
						<form id="logoutForm" action="{{ route('logout') }}" method="POST">
							@csrf
							<button type="submit" class="dropdown-item d-flex">
								<i class="feather feather-power ml-3 fs-16 my-auto"></i>
								<span class="mt-1">خروج</span>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/app header-->

<!--Sidebar-right-->
<div class="sidebar sidebar-right sidebar-animate">
    <div class="card-header border-bottom pb-5">
        <h4 class="card-title">اعلان ها </h4>
        <div class="card-options">
            <a href="#" class="btn btn-sm btn-icon btn-light text-primary"  data-toggle="sidebar-right" data-target=".sidebar-right"><i class="feather feather-x"></i> </a>
        </div>
    </div>
    <div class="">
        <div class="list-group-item  align-items-center border-0">
            <div class="d-flex">
                <span class="avatar avatar-lg brround m-2"></span>
                <div class="mt-1">
                    <a href="#" class="font-weight-semibold fs-16">Liam <span class="text-muted font-weight-normal">فرستادن پیام</span></a>
                    <span class="clearfix"></span>
                    <span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>2 دقیقه پیش</span>
                </div>
                <div class="ml-auto">
                    <a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="feather feather-more-horizontal"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left" role="menu">
                        <li><a href="#"><i class="feather feather-eye ml-2"></i>بازدید</a></li>
                        <li><a href="#"><i class="feather feather-plus-circle ml-2"></i>اضافه</a></li>
                        <li><a href="#"><i class="feather feather-trash-2 ml-2"></i>حذف</a></li>
                        <li><a href="#"><i class="feather feather-settings ml-2"></i>بیشتر</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Sidebar-right-->

<!--Change password Modal -->
<div class="modal fade"  id="changepasswordnmodal">
	<div class="modal-dialog" role="document">
		<x-password_error></x-password_error>
		<div class="modal-content">
			<form action="{{ route('change-password') }}" class="card-body pt-3" id="change-password" name="change-password" method="post">
			@csrf
			@method('PUT')
				<div class="modal-header">
					<h5 class="modal-title">تغییر گذرواژه</h5>
					<button  class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="form-group">
							<label class="form-label">گذرواژه قبلی</label>
							<input type="password" class="form-control"name="old_password" placeholder="گذرواژه قبلی">
						</div>
						<div class="form-group">
							<label class="form-label">گذرواژه جديد</label>
							<input type="password" class="form-control"name="password" placeholder="گذرواژه جديد">
						</div>
						<div class="form-group">
							<label class="form-label">تکرار گذرواژه جدید</label>
							<input type="password" class="form-control"name="password_confirmation" placeholder="تکرار گذرواژه">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-outline-primary" data-dismiss="modal">بستن</a>
					<button class="btn btn-success" type="submit">بروزرسانی</button>
				</div>
			</form>
		</div>
	</div>
</div>
@if (session('password-error') == 'wrong')
	<script>
		window.addEventListener('load', function() {
			document.getElementById('change_password').click();
		});
	</script>	
@endif
<!-- End Change password Modal  -->
