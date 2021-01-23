<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <meta name="title" content="PROradius Invoicing">
    <meta name="description" content="PROradius Invoicing , The better way to make, move and manage your money" >

    <title>{{ config('app.name', 'Address Book') }} | @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js" integrity="sha256-4O4pS1SH31ZqrSO2A/2QJTVjTPqVe+jnYgOWUVr7EEc=" crossorigin="anonymous"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{url('/css/fonts.css')}}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha256-eSi1q2PG6J7g7ib17yAaWMcrr5GrtohYChqibrV7PBE=" crossorigin="anonymous" />
    @yield('page-css')
    <link rel="stylesheet" href="{!! mix('css/app.css') !!}">
    <link rel="stylesheet" href="{!! mix('css/custom.css') !!}">

</head>
<body class="login"  data-background-color="bf1">

@yield('auth')
@auth
    <div class="wrapper ">


        @include('shared.main_header')
        @include('shared.sidebar')

        <div class="main-panel">
            @yield('content')
        </div>

    </div>

@endauth

</body>
<!-- Scripts -->

<script src="{{mix('js/vendor.js')}}"></script>
@yield('page-js')
<script src="{{mix('js/app.js')}}"></script>
@yield('custom-js')

<script>

    $(window).resize(function() {
        $(window).width();
    });


</script>
</html>
