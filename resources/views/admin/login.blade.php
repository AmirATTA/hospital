<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard." name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard"/>

		<!-- Title -->
		<title>صفحه ورود برنامه بیمارستان</title>

		<!--Favicon -->
		<link rel="icon" href="{{ asset('assets/images/brand/favicon.ico') }}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{ asset('assets/css-rtl/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css-rtl/dark.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css-rtl/skin-modes.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/font.css') }}" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{ asset('assets/css-rtl/animated.css') }}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ asset('assets/css-rtl/icons.css') }}" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

		
		<!-- INTERNAL Notifications  Css -->
		<link href="{{ asset('assets/plugins/notify/css/jquery.growl-rtl.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
	</head>

	<body>

		<div class="page login-bg">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="row justify-content-center">
								<div class="col-md-7 col-lg-5">
									<div class="card">
										<div class="p-4 pt-6 text-center">
											<span class="mb-2 display-4">ورود</span>
											<p class="text-muted">ورود به برنامه</p>
										</div>

										<div class="p-5">
											<x-errors></x-errors>
										</div>

										<form action="{{ route('login.post') }}" class="card-body pt-3" id="login" name="login" method="post">
										@csrf
											<div class="form-group">
												<label class="form-label">شماره موبايل</label>
												<input class="form-control" placeholder="شماره موبايل" type="text" name="mobile" value="{{ old('mobile') }}">
											</div>
											<div class="form-group">
												<label class="form-label">گذرواژه</label>
												<input class="form-control" placeholder="گذرواژه" type="password" name="password">
											</div>
											<div class="submit">
												<button type="submit" class="btn btn-primary btn-block">ورود</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Jquery js-->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!-- Bootstrap4 js-->
		<script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- Select2 js -->
		<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

		<!-- P-scroll js-->
		<script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>

		<!-- Custom js-->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

		
		<!-- INTERNAL Notifications js -->
		<script src="{{ asset('assets/plugins/notify/js/rainbow.js') }}"></script>
		<script src="{{ asset('assets/plugins/notify/js/sample.js') }}"></script>
		<script src="{{ asset('assets/plugins/notify/js/jquery.growl.js') }}"></script>
		<script src="{{ asset('assets/plugins/notify/js/notifIt-rtl.js') }}"></script>
	</body>
</html>
