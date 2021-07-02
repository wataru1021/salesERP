<div class="c-wrapper">
	<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
		<button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button><a class="c-header-brand d-sm-none" href="#"><img class="c-header-brand" src="{{ url('/assets/brand/sale_erp_logo_minimize.png') }}" width="auto" height="auto" alt="Sale ERP Logo">Sale ERP</a>
		<button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
		<?php
		?> 
		<ul class="c-header-nav d-md-down-none">
			<li class="c-header-nav-item dropdown px-3">
				<a class="c-header-nav-link" href="#">Top</a>
			</li>
		</ul>
		<ul class="c-header-nav d-md-down-none">
			<li class="c-header-nav-item dropdown px-3">
				<a class="c-header-nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="#">全営業マンの報告管理</a>
				<div class="dropdown-menu">
					<a class="c-header-nav-link dropdown-item" href="http://localhost/">
						<span class="c-header-nav-icon"></span>営業マン毎の営業成績
					</a>
					<a class="c-header-nav-link dropdown-item" href="http://localhost/">
						<span class="c-header-nav-icon"></span>指標毎の営業マン成績
					</a>
				</div>
			</li>
		</ul>
		<ul class="c-header-nav d-md-down-none">
			<li class="c-header-nav-item dropdown px-3">
				<a class="c-header-nav-link" href="#">営業マン管理</a>
			</li>
		</ul>
		<ul class="c-header-nav ml-auto mr-4">
			<li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<div class="c-avatar"><img class="c-avatar-img" src="{{ url('/assets/img/avatars/avatar.png') }}" alt="user@email.com"></div>
				</a>
				<div class="dropdown-menu dropdown-menu-right pt-0">
					<a class="dropdown-item" href="#">
						<svg class="c-icon mr-2">
							<use xlink:href="{{ url('/icons/sprites/free.svg#cil-account-logout') }}"></use>
						</svg>
						<form action="{{ url('/logout') }}" method="POST"> @csrf <button type="submit" class="btn btn-ghost-dark btn-block">Logout</button></form>
					</a>
				</div>
			</li>
		</ul>
		<div class="c-subheader px-3">
			<ol class="breadcrumb border-0 m-0">
				<li class="breadcrumb-item"><a href="/">Top</a></li>
			</ol>
		</div>
	</header>