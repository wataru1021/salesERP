<div class="c-wrapper">
	<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
		<button class="c-header-toggler c-class-toggler d-lg-none mr-auto menu-icon-sales" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
		<button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
		<ul class="c-header-nav d-md-down-none">
			<li class="c-header-nav-item dropdown px-3">
				<a class="c-header-nav-link {{ $isActiveHeader == 'top' ? 'is-active-header' : '' }}" href="{{ route('home') }}">Top</a>
			</li>
		</ul>
		<ul class="c-header-nav d-md-down-none">
			<li class="c-header-nav-item dropdown px-3">
				<a class="c-header-nav-link {{ $isActiveHeader == 'salesManagement' ? 'is-active-header' : '' }}" href="{{ route('salesManagement') }}">営業管理</a>
			</li>
		</ul>
		<ul class="c-header-nav d-md-down-none">
			<li class="c-header-nav-item dropdown px-3">
				<a class="c-header-nav-link {{ $isActiveHeader == 'sales-login-change-password' ? 'is-active-header' : '' }}" href="{{route('sales.changePassword.index')}}">パスワード変更</a>
			</li>
		</ul>
	</header>
