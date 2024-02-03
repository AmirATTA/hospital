				<!--aside open-->

				@php
					$user = auth()->user();
				@endphp

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

							@if($user->can('view users') || $user->can('create users') || $user->can('update users') || $user->can('delete users'))
								<li class="slide">
									<a class="side-menu__item" data-toggle="slide" href="#">
										<i class="fa-solid fa-user-tie sidemenu_icon"></i>
										<span class="side-menu__label">مدیریت کابران</span><i class="angle fa fa-angle-left"></i>
									</a>
									<ul class="slide-menu">
										@can('create users')
											<li><a href="{{ route('users.create') }}" class="slide-item">کاربر جدید</a></li>
										@endcan
										@can('view users')
											<li><a href="{{ route('users.index') }}" class="slide-item">لیست کاربر ها</a></li>
										@endcan
									</ul>
								</li>
							@endif

							@if($user->can('view specialities') || $user->can('create specialities') || $user->can('update specialities') || $user->can('delete specialities'))
								<li class="slide">
									<a class="side-menu__item" data-toggle="slide" href="#">
										<i class="fa-solid fa-certificate sidemenu_icon"></i>
										<span class="side-menu__label">تخصص ها</span><i class="angle fa fa-angle-left"></i>
									</a>
									<ul class="slide-menu">
										@can('create specialities')
											<li><a href="{{ route('specialities.create') }}" class="slide-item">تخصص جدید</a></li>
										@endcan
										@can('view specialities')
											<li><a href="{{ route('specialities.index') }}" class="slide-item">لیست تخصص ها</a></li>
										@endcan
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</aside>
				<!--aside closed-->