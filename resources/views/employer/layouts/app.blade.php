<!DOCTYPE html>

<html class="loading @auth {{auth()->user()->theam_mode}} @endauth" lang="en" data-textdirection="ltr">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{config('app.name')}}</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    
@include('employer.layouts.css')
        @yield('css')

</head>
    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
            <!-- BEGIN: Header-->
            @include('employer.layouts.header')
            <!-- END: Header-->

            <!-- BEGIN: Main Menu-->
            @include('employer.layouts.sidebar')
            <!-- END: Main Menu-->

            <!-- BEGIN: Content-->
            @yield('content')

            <!-- END: Content-->

            <div class="sidenav-overlay"></div>
            <div class="drag-target"></div>

            <!-- BEGIN: Footer-->
            @include('employer.layouts.footer')
            @include('employer.layouts.js')
            @yield('script')
    </body>
</html>
