<!doctype html>
<html lang="en">

 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}bootstrap/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{ asset('/') }}bootstrap/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}bootstrap/assets/libs/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}bootstrap/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <!-- Punya aku CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}meassets/css/myfooter.css">
</head>

<body>
    {{-- @include('layouts.navbar'); --}}
    
    {{-- <div class="container">
        @yield('container')
    </div> --}}

        <!-- ============================================================== -->
        <!-- main wrapper -->
        <!-- ============================================================== -->
        <div class="dashboard-main-wrapper">
            @include('layouts.navbar');
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Blank Pageheader </h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Blank Pageheader</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h3 class="text-center">Content goes here!</h3>
                    </div>
                    
                </div>
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- basic list  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-2"> </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <h5 class="card-header">Basic</h5>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item active">Cras justo odio</li>
                                    <li class="list-group-item">Dapibus ac facilisis in</li>
                                    <li class="list-group-item">Morbi leo risus</li>
                                    <li class="list-group-item">Porta ac consectetur ac</li>
                                    <li class="list-group-item">Vestibulum at eros</li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
            
        </div>

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                    {{-- <div class="footer-area"> --}}
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->

            <footer >
                <p>copyright</p>
            </footer>


    <!-- Optional JavaScript -->
    <script src="{{ asset('/') }}bootstrap/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('/') }}bootstrap/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{ asset('/') }}bootstrap/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="{{ asset('/') }}bootstrap/assets/libs/js/main-js.js"></script>
</body>
 
</html>