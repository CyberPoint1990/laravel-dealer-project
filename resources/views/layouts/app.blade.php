<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - Admindek</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    
    @stack('styles')

    <style>
        /* Sidebar/Wrapper Smooth Transition */
        #wrapper { overflow-x: hidden; }
        #page-content-wrapper { min-width: 0; width: 100%; transition: margin .25s ease-out; }
    </style>
</head>
<body class="bg-light">

    <div class="d-flex" id="wrapper">
        @include('layouts.sidebar') 

        <div id="page-content-wrapper">
            @include('layouts.navigation')

            <div class="container-fluid p-4">
                {{-- Toast Alerts Container --}}
                @include('partials.alerts')

                {{-- Page Main Content --}}
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alertList = document.querySelectorAll('.alert:not(.alert-important)');
            alertList.forEach(function(alert) {
                setTimeout(function() {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>

    @stack('scripts')

</body>
</html>