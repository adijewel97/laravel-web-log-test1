<!DOCTYPE html>
<html lang="en">

@include('layouts.header')
{{-- <body class="hold-transition layout-footer-fixed fixed  sidebar-mini text-sm layout-fixed"> --}}

{{-- <body data-scrollbar-auto-hide="n" class="sidebar-mini layout-navbar-fixed layout-footer-fixed text-sm"
    style="height: auto;"> --}}

<body class="hold-transition sidebar-mini layout-fixed">
    {{-- Panggil Navbar utnuk menu dinamsis --}}
    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')

        {{-- Memanggil layaut conten masing" form  --}}
        @yield('container')

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block" style="font-size: 9px">
                <strong>Copyright &copy; 2023 <a href="">Mang-Adis</a>.</strong>
            </div>

            <b style="font-size: 8px">Ver 1.0.0</b>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>
    </div>

    @include('layouts.footer')
    @yield('addfooterjs')
</body>

</html>
