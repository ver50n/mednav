<nav class="navbar navbar-light navbar-expand-md"  style="background-color: #ffc9f6;">
	<div class="navbar-brand-wrapper">
		<a class="navbar-brand" href="{{ route('staff.dashboard') }}">
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
			@if(Auth::guard('web')->check())
			<li class="nav-item">
				<a class="nav-link" href="{{ route('staff.dashboard') }}">
					<i class="c_icon fas fa-home menu-icon"></i> @lang('common.dashboard')
				</a>
			</li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="c_icon fas fa-list menu-icon"></i> @lang('common.work-data')
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="{{ route('staff.callcenter.list') }}" class="dropdown-item ">
							<i class="c_icon fas fa-phone menu-icon"></i> @lang('common.callcenter')
						</a>
					</li>
				</ul>
			</li>
			@endif
		</ul>
		<ul class="navbar-nav ml-auto">
			@if(Auth::guard('web')->check())
			<li class="nav-item">
				<a class="nav-link" href="{{ route('staff.setting') }}">
					<i class="c_icon fas fa-cogs menu-icon"></i> 設定
				</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="c_icon fas fa-power-off menu-icon"></i> Logout
					<form id="logout-form"
						action="{{ route('staff.logout')  }}"
						method="POST"
						style="display: none;">
						{{ csrf_field() }}
					</form>
				</a>
			</li>
			@else
			<li class="nav-item">
				<a class="nav-link" href="{{ route('staff.login') }}">
				  <i class="c_icon fas fa-sign-in-alt menu-icon"></i> ログイン
				</a>
			</li>
			@endif
		</ul>
	</div>
</nav>