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

    <title>Halaman tidak ditemukan!</title>

    <!--begin::Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap">
    <!--end::Fonts -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ asset('metronic/assets/css/error/error-404.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Styles -->
</head>
<!-- end::Head -->

<!-- begin::Body -->

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v3"
            style="background-image: url({{ asset("metronic/assets/media/bg/error404.jpg") }});">
            <div class="kt-error_container">
                <span class="kt-error_number">
                    <h1>404</h1>
                </span>
                <p class="kt-error_title">
                    Halaman tidak ditemukan.
                </p>
                <p class="kt-error_subtitle">
                    Mungkin ada kesalahan penulisan url, <br>
                    atau halaman yang Anda cari tidak lagi ada.
                </p>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
</body>

<!-- end::Body -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

</html>