<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendors/select2/select2.min.css') }}">
    <!-- Styles -->

  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" /> --}}

  <!-- Scripts -->
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <!-- End plugin css for this page -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->
    <!-- Include the Dark theme -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/css/demo2/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('../backend/assets/images/favicon.png') }}" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
</head>
@include('sweetalert::alert')
<body>
    <div class="main-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.nav.sidebar')
        <!-- partial -->
        <div class="page-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.nav.header')
            <!-- partial -->

            @yield('admin')

            <!-- partial:partials/_footer.html -->
            @include('admin.nav.footer')
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('../backend/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('../backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
	<script src="{{ asset('../backend/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
	<script src="{{ asset('../backend/assets/vendors/select2/select2.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('../backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../backend/assets/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('../backend/assets/js/dashboard-dark.js') }}"></script>

	<script src="{{ asset('../backend/assets/js/inputmask.js') }}"></script>
	<script src="{{ asset('../backend/assets/js/select2.js') }}"></script>
    <!-- End custom js for this page -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('../backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('../backend/assets/js/data-table.js') }}"></script>
    {{-- <script src="{{ asset('../backend/assets/js/sweet-alert.js') }}"></script> --}}
    <!-- End custom js for this page -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
    </script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                // toastr.info(" {{ Session::get('message') }} ");
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: " {{ Session::get('message') }} ",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1500
                })
                break;

            case 'success':
                // toastr.success(" {{ Session::get('message') }} ");
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: " {{ Session::get('message') }} ",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1500
                })
                break;

            case 'warning':
                // toastr.warning(" {{ Session::get('message') }} ");
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: " {{ Session::get('message') }} ",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1500
                })
                break;

            case 'error':
                // toastr.error(" {{ Session::get('message') }} ");
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: " {{ Session::get('message') }} ",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1500
                })
                break;
        }
        @endif

    </script>
    {{-- <script src="{{ asset('../backend/assets/js/jquery-3.7.0.min.js') }}"></script> --}}
    {{-- @yield('script') --}}
    {{-- @include('components.modal-edit-sources') --}}
    @stack('js')
</body>
</html>
{{-- {{ $profileData }} --}}

