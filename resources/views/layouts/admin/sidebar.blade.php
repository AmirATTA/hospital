				<!--aside open-->
				<aside class="app-sidebar">
					<div class="app-sidebar__logo p-4 mt-2" style="border:none;">
						<a class="header-brand" href="{{ route('dashboard.index') }}">
							<img src="{{ asset('assets/images/hospital_logo.png') }}" class="header-brand-img dark-logo" alt="Dayonelogo">
						</a>
					</div>
					<div class="app-sidebar3">
						<ul class="side-menu">
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="{{ route('dashboard.index') }}">
									<i class="feather feather-home sidemenu_icon"></i>
									<span class="side-menu__label">داشبورد</span></i>
								</a>
							</li>

							@php
								$user = auth()->user();
							@endphp
							@if($user->can('view user') || $user->can('create user') || $user->can('update user') || $user->can('delete user'))
								<li class="slide">
									<a class="side-menu__item" data-toggle="slide" href="#">
										<i class="fa-solid fa-user-tie sidemenu_icon"></i>
										<span class="side-menu__label">مدیریت کابران</span><i class="angle fa fa-angle-left"></i>
									</a>
									<ul class="slide-menu">
										@can('create user')
											<li><a href="{{ route('users.create') }}" class="slide-item">کاربر جدید</a></li>
										@endcan
										@can('view user')
											<li><a href="{{ route('users.index') }}" class="slide-item">لیست کاربر ها</a></li>
										@endcan
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</aside>
				<!--aside closed-->