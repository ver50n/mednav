<nav class="navbar navbar-light navbar-expand-md" style="background-color: #6b7fff;">
	<div class="navbar-brand-wrapper">
		<a class="navbar-brand" href="{{ route('manage.dashboard') }}">
			| @lang('common.brand') | 
		</a>
	</div>
	<button class="navbar-toggler"
		type="button"
		data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent"
		aria-expanded="false" aria-label="Toggle navigation">
		<i class="c_icon fas fa-list"></i>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav">
			@if(Auth::guard('admin')->check())
			<li class="nav-item">
				<a class="nav-link" href="{{ route('manage.dashboard') }}">
					<i class="c_icon fas fa-home menu-icon"></i> @lang('common.dashboard')
				</a>
			</li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="c_icon fas fa-database menu-icon"></i> @lang('common.master')
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="{{ route('manage.admin.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-user-shield menu-icon"></i> @lang('common.admin')
						</a>
					</li>
					<li>
						<a href="{{ route('manage.user.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-user menu-icon"></i> @lang('common.user')
						</a>
					</li>
					<li>
						<a href="{{ route('manage.place.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-map-marked menu-icon"></i> @lang('common.place')
						</a>
					</li>
				</ul>
            </li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="c_icon fas fa-list menu-icon"></i> @lang('common.work-data')
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="{{ route('manage.callcenter.list') }}" class="dropdown-item ">
							<i class="c_icon fas fa-phone menu-icon"></i> @lang('common.callcenter')
						</a>
					</li>
				</ul>
			</li>
			@endif
		</ul>
		<ul class="navbar-nav ml-auto">
			@if(Auth::guard('admin')->check())
			<li class="nav-item">
				<a class="nav-link" href="{{ route('manage.setting') }}">
					<i class="c_icon fas fa-cogs menu-icon"></i> 設定
				</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="c_icon fas fa-power-off menu-icon"></i> Logout
					<form id="logout-form"
						action="{{ route('manage.logout')  }}"
						method="POST"
						style="display: none;">
						{{ csrf_field() }}
					</form>
				</a>
			</li>
			@else
			<li class="nav-item">
				<a class="nav-link" href="{{ route('manage.login') }}">
				  <i class="c_icon fas fa-sign-in-alt menu-icon"></i> ログイン
				</a>
			</li>
			@endif
		</ul>
	</div>
</nav>