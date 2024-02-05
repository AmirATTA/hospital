<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

		<!-- Title -->
		<title>داشبورد - {{ config('app.name')}}</title>

		<!--Favicon -->
		<link rel="icon" href="{{ asset('assets/images/brand/favicon.png') }}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{ asset('assets/css-rtl/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css-rtl/dark.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css-rtl/skin-modes.css') }}" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{ asset('assets/css-rtl/animated.css') }}" rel="stylesheet" />

		<!--Sidemenu css -->
        <link  href="{{ asset('assets/css-rtl/sidemenu.css') }}" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ asset('assets/css-rtl/icons.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/plugins/iconfonts/font-awesome/css/fontawesome.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/plugins/iconfonts/font-awesome/css/all.min.css') }}" rel="stylesheet" />

		<!---Sidebar css-->
		<link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

		<!--- INTERNAL jvectormap css-->
		<link href="{{ asset('assets/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet" />

		<!-- INTERNAL jQuery-countdowntimer css -->
		<link href="{{ asset('assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.css') }}" rel="stylesheet" />

		<link href="{{ asset('assets/css-rtl/style-rtl.css') }}" rel="stylesheet" />

		<!-- Extentions -->
		@yield('links')
	</head>

	<body class="app sidebar-mini">

		<!---Global-loader-->
		<div id="global-loader" >
			<div class="card-body spin-loader">
				<div class="sk-cube-grid" style="margin:0;">
					<div class="sk-cube sk-cube1"></div>
					<div class="sk-cube sk-cube2"></div>
					<div class="sk-cube sk-cube3"></div>
					<div class="sk-cube sk-cube4"></div>
					<div class="sk-cube sk-cube5"></div>
					<div class="sk-cube sk-cube6"></div>
					<div class="sk-cube sk-cube7"></div>
					<div class="sk-cube sk-cube8"></div>
					<div class="sk-cube sk-cube9"></div>
				</div>
			</div>
		</div>

		<div class="page">
			<div class="page-main">

				@include('layouts.admin.sidebar')

				<div class="app-content main-content">
					<div class="side-app">

						@include('layouts.admin.header')

						<ol class="breadcrumb1" style="position:absolute;top:80px;margin-right:-15px;margin-top: 20px;">
							<li class="breadcrumb-item1"><a href="{{ route('dashboard.index') }}"><i class="feather feather-home"></i> Dashboard</a></li>
							<?php $segments = ''; ?>

							@foreach(Request::segments() as $segment)
								@if($segment != 'admin' 
									&& $segment != 'dashboard' 
									&& !is_numeric($segment))

									<?php $segments .= '/'.$segment; ?>
									<li class="breadcrumb-item1">
										<a href="{{ url("admin$segments") }}">{{$segment}}</a>
									</li>

								@endif
							@endforeach
						</ol>
						
						<!--Page header-->
						<div class="page-header d-xl-flex d-block" style="margin-top: 70px;">
							<div class="page-leftheader">
								<h4 class="page-title"><span class="font-weight-normal page-title ml-2" style="font-family: yekan;">@yield('title')</span></h4>
							</div>
						</div>
						<!--End Page header-->
						
					<!-- ######==================--------------================###### -->

												@yield('content')						

					<!-- ######==================--------------================###### -->

					</div>
				</div>
			</div>

			@include('layouts.admin.footer')

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
							<span class="avatar avatar-lg brround mr-3"></span>
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

			<!--Clock-IN Modal -->
			<div class="modal fade"  id="clockinmodal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><span class="feather feather-clock  mr-1"></span>Clock In</h5>
							<button  class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="countdowntimer"><span id="clocktimer" class="border-0"></span></div>
							<div class="form-group">
								<label class="form-label">Note:</label>
								<textarea class="form-control" rows="3">Some text here...</textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button  class="btn btn-outline-primary" data-dismiss="modal">Close</button>
							<button  class="btn btn-primary">Clock In</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End Clock-IN Modal  -->

		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

		<!-- Jquery js-->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!--Moment js-->
		<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

		<!-- Bootstrap4 js-->
		<script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!--Sidemenu js-->
		<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

		<!-- P-scroll js-->
		<script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>

		<!--Sidebar js-->
		<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

		<!-- Select2 js -->
		<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

		<!-- INTERNAL Vertical-scroll js-->
		<script src="{{ asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js') }}"></script>
		<script src="{{ asset('assets/plugins/vertical-scroll/vertical-scroll.js') }}"></script>

		<!-- INTERNAL Timepicker js -->
		<script src="{{ asset('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
		<script src="{{ asset('assets/plugins/time-picker/toggles.min.js') }}"></script>

		<!-- INTERNAL Chartjs rounded-barchart -->
		<script src="{{ asset('assets/plugins/chart.min/chart.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/chart.min/rounded-barchart.js') }}"></script>

		<!-- INTERNAL jQuery-countdowntimer js -->
		<script src="{{ asset('assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js') }}"></script>

		<!-- INTERNAL Index js-->
		<script src="{{ asset('assets/js/index1.js') }}"></script>

		<!-- INTERNAL popover js -->
		<script src="{{ asset('assets/js/popover.js') }}"></script>

		<!-- Custom js-->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

		<!-- Extentions -->
		@yield('scripts')

	</body>
</html>