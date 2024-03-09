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
		<title>{{ config('app.name')}}</title>

		<!--Favicon -->
		<link rel="icon" href="{{ asset('assets/images/brand/favicon.ico') }}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{ asset('assets/css-rtl/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css-rtl/dark.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css-rtl/skin-modes.css') }}" rel="stylesheet" />

		<link href="{{ asset('assets/css/font.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css-rtl/util.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css-rtl/login.css') }}" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{ asset('assets/css-rtl/animated.css') }}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ asset('assets/css-rtl/icons.css') }}" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

	</head>

	<body>

		<div class="page error-bg">
			<div class="page-content m-0">
				<div class="container text-center">
					<div class="display-1 text-primary mb-5 font-weight-bold">4<span class="fa fa-smile-o"></span>4</div>
					<h1 class="mb-3 font-weight-semibold">با عرض پوزش، خطایی رخ داده است، صفحه درخواستی یافت نشد!</h1>
					<p class="font-weight-normal mb-7 leading-normal" style="font-size:1rem;">ممکن است آدرس را اشتباه تایپ کرده باشید یا صفحه جابجا شده باشد.</p>
					<a class="btn btn-primary" href="{{ route('dashboard.index') }}"><i class="fe fe-arrow-right-circle ml-1"></i>برگشت به داشبورد</a>
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

	</body>
</html>