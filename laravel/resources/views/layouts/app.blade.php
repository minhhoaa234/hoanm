<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/userProfile.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('css/indexAdmin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dReport.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet"> 

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>


    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('js/sb-admin-2.js') }}" defer></script>

    <script src="{{ asset('js/ckeditor/ckeditor.js') }}" defer></script>
    {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    @stack('pageCss')
    @stack('pageJs')
</head>
<body>
    <div id="wrapper">
         <div class="loadajax">
            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
        </div>
        <div class="show-errors">
            <span class="hide-errors">x</span>
        </div>
        <div>
            @auth                   
                @include('layouts.header')                   
            @endauth
        </div>
        @if (auth()->guard()->check())
        <div id="page-wrapper">     
            @yield('content')
        </div>
        
        @else
        @yield('content')
        @endif

    </div>
</body>
</html>
