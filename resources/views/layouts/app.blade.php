<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('page_title')</title>
    <!-- Fonts -->
  

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/job_style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include("layouts.header")
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('plugins/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('plugins/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    @yield("scripts")
</body>
</html>
