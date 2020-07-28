<!DOCTYPE html>
<html lang="id">

<!-- begin::Head -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/ico" />
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Administrasi KDCW {{ date('Y') }} - @yield('title')</title>

	<!--begin::Fonts -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap">
	<!--end::Fonts -->

	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('metronic/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->

	<!--begin::Page Vendors Styles(used by this page) -->
	@yield('vendor-css')
	<!--end::Page Vendor Styles -->
</head>
<!-- end::Head -->

@yield('content') <!--content here. -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
@yield('vendor-js')
<!--end::Page Vendors -->
</html>