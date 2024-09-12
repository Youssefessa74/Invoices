<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Perfect Scrollbar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/perfect-scrollbar/1.5.3/css/perfect-scrollbar.min.css">

    <!-- Other Stylesheets -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css') }}">

    <script>
        var PusherKey = "{{ config('PusherSettings.key') }}";
        var PusherCluster = "{{ config('PusherSettings.cluster') }}";
        var LoggedInUserId = "{{ auth()->user()->id }}" ;
    </script>
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.body.sidebar')
        <!-- partial -->
        @include('admin.body.header')

        <div class="page-wrapper" style="margin-top: 80px;">


            @yield('content')

            <!-- partial:partials/_footer.html -->
            @include('admin.body.footer')
            <!-- partial -->
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('admins/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('node_modules/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/template.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>
    <script src="{{ asset('backend/assets/js/dashboard-dark.js') }}"></script>
    <script src="{{ asset('backend/assets/js/colorpicker.js') }}"></script>
    <script src="{{ asset('backend/assets/js/code/code.js') }}"></script>
    <script src="{{ asset('backend/assets/js/code/validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/perfect-scrollbar/1.5.3/js/perfect-scrollbar.min.js"></script>



    <script>
        flash().success('Operation completed successfully.');
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toaster.error('{{ $error }}');
            @endforeach
        @endif

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

    @stack('scripts')
</body>

</html>
