<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- begin::Head -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/ico" />
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title')</title>

	<!--begin::Fonts -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap">

	<!--end::Fonts -->

	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('metronic/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->

	<!--begin::Page Vendors Styles(used by this page) -->
	@yield('vendor-css')
	<!--end::Page Vendor Styles -->

	<!--begin::php get route -->
	@php

	# Get current request route
	$dashboard = request()->routeIs('dashboard');
	$persuratan = request()->routeIs('persuratan*');
	$anggota = request()->routeIs('anggota*');
	$jabatan = request()->routeIs('jabatan*');
	$databarang = request()->routeIs('data-barang*');
	$peminjaman = request()->routeIs('peminjaman*');
	$rekappinjam = request()->routeIs('rekapan-peminjaman*');
	$keuangan = request()->routeIs('keuangan*');
	$relasi = request()->routeIs('relasi*');
	$profil = request()->routeIs('profil*');

	$administrasiGroup = ($persuratan || $anggota || $jabatan);
	$inventarisGroup = ($databarang || $peminjaman || $rekappinjam);
	$pinjamGroup = ($peminjaman || $rekappinjam);

	@endphp
	<!--end::php get route -->

</head>
<!-- end::Head -->

<!-- begin::Body -->

<body
	class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

	<!-- begin:: Page -->
	<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
		<div class="kt-header-mobile__logo">
			<a href="#">
				<img alt="Logo" src="{{ asset('img/header-mobile.png')}}" width="24%" />
			</a>
		</div>
		<div class="kt-header-mobile__toolbar">
			<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left"
				id="kt_aside_mobile_toggler"><span></span></button>
			<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
					class="flaticon-more"></i></button>
		</div>
	</div>

	<!-- end:: Header Mobile -->
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

			<!-- begin:: Aside -->
			<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
			<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
				id="kt_aside">

				<!-- begin:: Brand -->
				<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
					<div class="kt-aside__brand-logo">
						<a href="#">
							<img alt="Logo" src="{{ asset('img/logo.png') }}" width="100%" />
						</a>
					</div>
				</div>

				<!-- end:: Brand -->

				<!-- begin:: Aside Menu -->
				<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
					<div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1"
						data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
						<ul class="kt-menu__nav ">
							<li
								class="kt-menu__item  kt-menu__item--submenu {{ ($dashboard ? 'kt-menu__item--open kt-menu__item--here' : '') }}" title="Dashboard">
								<a href="{{ route('dashboard') }}" class="kt-menu__link"><i
										class="kt-menu__link-icon fa fa-home"></i><span
										class="kt-menu__link-text">Dashboard</span></a>
							</li>
							<li class="kt-menu__item  kt-menu__item--submenu {{ ($administrasiGroup ? 'kt-menu__item--open kt-menu__item--here' : '') }}"
								aria-haspopup="true" data-ktmenu-submenu-toggle="click" title="Adminisrasi"><a href="javascript:;"
									class="kt-menu__link kt-menu__toggle"><i
										class="kt-menu__link-icon fa fa-file-alt"></i><span
										class="kt-menu__link-text">Administrasi</span><i
										class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
												class="kt-menu__link"><span
													class="kt-menu__link-text">Administrasi</span></span></li>
										<li class="kt-menu__item {{ ($persuratan ? 'kt-menu__item--active' : '') }}" 
											aria-haspopup="true"><a href="#"
												class="kt-menu__link "><i
													class="kt-menu__link-icon la la-envelope"></i><span
													class="kt-menu__link-text">Persuratan</span></a></li>
										<li class="kt-menu__item {{ ($anggota ? 'kt-menu__item--active' : '') }}" 
											aria-haspopup="true"><a href="{{ route('anggota.index') }}"
												class="kt-menu__link "><i
													class="kt-menu__link-icon la la-users"></i><span
													class="kt-menu__link-text">Data Anggota</span></a></li>
										<li class="kt-menu__item {{ ($jabatan ? 'kt-menu__item--active' : '') }}"
											aria-haspopup="true"><a href="{{ route('jabatan.index') }}"
												class="kt-menu__link "><i
													class="kt-menu__link-icon la la-sitemap"></i><span
													class="kt-menu__link-text">Data Jabatan</span></a></li>
									</ul>
								</div>
							</li>
							<li class="kt-menu__item  kt-menu__item--submenu {{ ($inventarisGroup ? 'kt-menu__item--open kt-menu__item--here' : '') }}"
								aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-link-redirect="1"><a
									target="_blank" href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
										class="kt-menu__link-icon fa fa-boxes"></i><span
										class="kt-menu__link-text">Inventaris</span><i
										class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"
											data-ktmenu-link-redirect="1"><span class="kt-menu__link"><span
													class="kt-menu__link-text">Inventaris</span></span></li>
										<li class="kt-menu__item {{ ($databarang ? 'kt-menu__item--active' : '') }}" 
											aria-haspopup="true" data-ktmenu-link-redirect="1"><a
												href="#" class="kt-menu__link "><i
													class="kt-menu__link-icon la la-dropbox"><span></span></i><span
													class="kt-menu__link-text">Data Barang</span></a></li>
										<li class="kt-menu__item  kt-menu__item--submenu {{ ($pinjamGroup ? 'kt-menu__item--open kt-menu__item--here' : '') }}" 
											aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
												class="kt-menu__link kt-menu__toggle"><i
													class="kt-menu__link-icon la la-exchange"><span></span></i><span
													class="kt-menu__link-text">Peminjaman</span><i
													class="kt-menu__ver-arrow la la-angle-right"></i></a>
											<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
												<ul class="kt-menu__subnav">
													<li class="kt-menu__item {{ ($peminjaman ? 'kt-menu__item--active' : '') }}" 
														aria-haspopup="true"><a href="#"
															class="kt-menu__link "><i
																class="kt-menu__link-icon flaticon-clipboard"></i><span
																class="kt-menu__link-text">Data Barang
																Dipinjam</span></a></li>
													<li class="kt-menu__item {{ ($rekappinjam ? 'kt-menu__item--active' : '') }}" 
														aria-haspopup="true"><a href="#"
															class="kt-menu__link "><i
																class="kt-menu__link-icon flaticon-clock"></i><span
																class="kt-menu__link-text">Rekapan Peminjaman
																Barang</span></a></li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<li
								class="kt-menu__item  kt-menu__item--submenu {{ ($keuangan ? 'kt-menu__item--open kt-menu__item--here' : '') }}">
								<a href="{{ route('keuangan.index') }}" class="kt-menu__link"><i
										class="kt-menu__link-icon fa fa-dollar-sign"></i><span
										class="kt-menu__link-text">Keuangan</span></a>
							</li>
							<li
								class="kt-menu__item  kt-menu__item--submenu {{ ($relasi ? 'kt-menu__item--open kt-menu__item--here' : '') }}">
								<a href="{{ route('relasi.index') }}" class="kt-menu__link"><i
										class="kt-menu__link-icon fa fa-code-branch"></i><span
										class="kt-menu__link-text">Relasi</span></a>
							</li>
							<li
								class="kt-menu__item kt-menu__item--submenu kt-menu__item--bottom-1 {{ ($profil ? 'kt-menu__item--open kt-menu__item--here' : '') }}">
								<a href="{{ route('profil.index') }}" class="kt-menu__link"><i
										class="kt-menu__link-icon fa fa-user-cog"></i><span
										class="kt-menu__link-text">Profil</span></a>
							</li>
						</ul>
					</div>
				</div>

				<!-- end:: Aside Menu -->
			</div>
			<div class="kt-aside-menu-overlay"></div>

			<!-- end:: Aside -->
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

				<!-- begin:: Header -->
				<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">
					<div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">

					</div>
					<!-- begin:: Header Topbar -->
					<div class="kt-header__topbar">

						<!--begin: User bar -->
						<div class="kt-header__topbar-item kt-header__topbar-item--user">
							<div class="kt-header__topbar-wrapper" data-offset="10px,0px">
								<span class="kt-header__topbar-welcome text-right">
									Nama Lengkap <br> Jabatan
								</span>
								<img class="" alt="Pic" src="{{ asset('metronic/assets/media/users/300_21.jpg') }}" />
								&nbsp; &nbsp;
								<span class="kt-header__topbar-welcome">
									<a href="#logout" class="btn btn-label btn-label-danger btn-sm btn-bold">Logout</a>
								</span>
							</div>
						</div>

						<!--end: User bar -->
					</div>

					<!-- end:: Header Topbar -->
				</div>

				<!-- end:: Header -->
				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

					<!-- begin:: Subheader -->
					<div class="kt-subheader   kt-grid__item" id="kt_subheader">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-subheader__main">
								@yield('subheader-main')
							</div>
							<div class="kt-subheader__toolbar">
								<div class="kt-subheader__wrapper">
									<a href="#" class="btn kt-subheader__btn-daterange" data-toggle="kt-tooltip"
										title="Tanggal Hari Ini" data-placement="left">
										<span class="kt-subheader__btn-daterange-title">Tanggal : </span>&nbsp;
										<span class="kt-subheader__btn-daterange-date">{{ date("d/m/Y") }}</span>

										<!--<i class="flaticon2-calendar-1"></i>-->
										<svg xmlns="{{'http://www.w3.org/2000/svg'}}"
											xmlns:xlink="{{'http://www.w3.org/1999/xlink'}}" width="24px" height="24px"
											viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path
													d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
													fill="#000000" fill-rule="nonzero" opacity="0.3" />
												<path
													d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
													fill="#000000" />
											</g>
										</svg> </a>
								</div>
							</div>
						</div>
					</div>

					<!-- end:: Subheader -->

					<!-- begin:: Content -->
					<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
						@include('layouts.partials.alerts')
						@yield('content')
					</div>

					<!-- end:: Content -->
				</div>

				<!-- begin:: Footer -->
				<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-footer__copyright">
							2020&nbsp;&copy;&nbsp;<a href="{{'https://kedai.or.id'}}" target="_blank"
								class="kt-link">KeDai Computerworks</a>
						</div>
					</div>
				</div>

				<!-- end:: Footer -->
			</div>
		</div>
	</div>

	<!-- end:: Page -->

	<!-- begin::Scrolltop -->
	<div id="kt_scrolltop" class="kt-scrolltop">
		<i class="fa fa-arrow-up"></i>
	</div>

	<!-- end::Scrolltop -->

</body>

<!-- end::Body -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
@yield('vendor-js')

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('metronic/assets/js/pages/dashboard.js') }}" type="text/javascript"></script>

@yield('js')
<!--end::Page Scripts -->

</html>