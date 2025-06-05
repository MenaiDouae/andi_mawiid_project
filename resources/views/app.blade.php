<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title inertia>{{ config('app.name', 'Andi Mawiid') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body>

    <!-- Top Bar Start -->
    @include('partials.topbar')
    <!-- Top Bar End -->
    <!-- leftbar-tab-menu -->
    @include('partials.leftbar')
    <!-- end leftbar-tab-menu-->

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-xxl">
                @inertia
            </div>
            <!-- container -->

            <!--Start Rightbar-->
            <!--Start Rightbar/offcanvas-->
            @include('partials.rightbar')
            <!--end Rightbar/offcanvas-->
            <!--end Rightbar-->
            <!--Start Footer-->
            @include('partials.footer')
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/data/stock-prices.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
</body>
<!--end body-->
</html>