<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Skyrent Admin</title>
    <meta name="description" content="" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/page/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/page/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/page/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/page/css/button.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/pages/css/demo.css') }}" />

    <!-- page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/page/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/page/libs/apex-charts/apex-charts.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/page/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/pages/js/config.js') }}"></script>
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @section('sidebar')
        @include('admin.layout.sidebar')
        @show
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @section('navbar')
          @include('admin.layout.navbar')
          @show
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @yield('content')
            <!-- / Content wrapper -->
          </div>
        </div>
        <!-- / Layout page -->

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
      </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/page/js/core.js -->
    <script src="{{ asset('assets/page/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/page/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/page/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/page/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/page/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- page JS -->
    <script src="{{ asset('assets/page/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/pages/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/pages/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
