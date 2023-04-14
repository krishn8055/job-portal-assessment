<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <title> @yield('title') {{ config('app.name', 'Xcash') }}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ URL::asset('resources/uploads/logo/fav.png')}}" />
        @include('layouts.authCSS')
        @yield('css')


    </head>

    <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
        <div class="wrapper" id="app">
            @yield('content')
        </div>
        @include('layouts.authJS')
        @yield('script')

    </body>
</html>
