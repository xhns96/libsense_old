<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/admin-page/global.css')}}">
    <link rel="stylesheet" href="{{asset('kiosk/css/reset.css')}}"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{asset('kiosk/css/style.css')}}"> <!-- Resource style -->
    <link rel="stylesheet" href="{{asset('css/bi.css')}}">
    <link rel="stylesheet" href="{{asset('kiosk/css/custom.css')}}">
    <script src="{{asset('kiosk/js/modernizr.js')}}"></script> <!-- Modernizr -->
    <title>@yield('title')</title>
    @section('headerStyles')
        
    @endsection
</head>
<body>
@yield('content')

@section('footerScript')
    <script src="{{asset('js/admin-page/core/jquery.min.js')}}"> </script>
    <script src="{{asset('js/admin-page/core/popper.min.js')}}"> </script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('kiosk/js/jquery-2.1.1.js')}}"></script>

    <script src="{{asset('js/admin-page/core/sweetalert2.js')}}"> </script>
    <script type="text/javascript" src="{{asset('kiosk/adapter.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('kiosk/vue.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('kiosk/instascan.min.js')}}"></script>
    {{-- 2 QR/Barcode scanner <script src="{{asset('js/html5-qrcode.min.js')}}"></script> --}}
    <script src="{{asset('kiosk/js/main.js')}}"></script> <!-- Resource jQuery -->
@show
</body>
</html>
