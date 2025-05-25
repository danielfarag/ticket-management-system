<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
        <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    
        <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    
        <link rel="stylesheet" href="/adminlte/plugins/jqvmap/jqvmap.min.css">
    
        <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
    
        <link rel="stylesheet" href="/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    
        <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
    
        <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
        <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">
    
        <!-- Scripts -->
        @routes

        <script defer src="/adminlte/plugins/jquery/jquery.min.js"></script>
        <script defer src="/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script>
        // $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script defer src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script defer src="/adminlte/plugins/chart.js/Chart.min.js"></script>
        <script defer src="/adminlte/plugins/sparklines/sparkline.js"></script>
        <script defer src="/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script defer src="/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <script defer src="/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
        <script defer src="/adminlte/plugins/moment/moment.min.js"></script>
        <script defer src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
        <script defer src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script defer src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
        <script defer src="/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script defer src="/adminlte/js/adminlte.js"></script>
        <script defer src="/adminlte/js/demo.js"></script>
        <script defer src="/adminlte/js/pages/dashboard.js"></script>
        <script defer src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

        <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ mix('js/website.js') }}" defer></script>

    </head>
    <body>
        @inertia

        

        @env ('local')
            {{-- <script src="http://localhost:8080/js/bundle.js"></script> --}}
        @endenv
    </body>
</html>
