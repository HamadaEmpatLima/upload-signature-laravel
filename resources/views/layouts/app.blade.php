<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.meta')
    <title>@yield('title') | KodegiriHamada</title>
    @include('layouts.css')
    @stack('styles')
    <style>
        .toast {
            left: 50%;
            position: fixed;
            transform: translate(-50%, 0px);
            z-index: 9999;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"') }}>
        </div> --}}

        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('layouts.js')
    @stack('scripts')
    @include('layouts.script')
    @stack('modals')
</body>

</html>
