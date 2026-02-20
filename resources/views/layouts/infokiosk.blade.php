<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('infokiosk/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('infokiosk/css/owl.carousel.min.css')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/core/logo.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bi.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin-page/global.css')}}">
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('infokiosk/css/style.css')}}">
    @section('headerStyles')
    @show
    <title>@yield('title','Infokiosk')</title>

</head>
<body>


<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>



<header class="site-navbar site-navbar-target py-4" role="banner">

    <div class="container">
        <div class="row align-items-center position-relative">

            <div class="col-3">
                <div class="site-logo">
                    <a href="index.html" class="font-weight-bold text-white">Libsense kiosk</a>
                </div>
            </div>

            <div class="col-9  text-right">


                <span class="d-inline-block d-lg-block" style="margin-right: -70px"><a href="#" class="text-black site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3" style="color: whitesmoke;font-size: 4rem; text-shadow: wheat 2px 2px 5px" ></span></a></span>



                <nav class="site-navigation text-right ml-auto d-none d-lg-none" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto " style="text-align: center">
                        <li class="active"><a href="{{route('admin.infokiosk.index')}}" class="nav-link text-orange" style="font-weight: bold"><img class="mb-2 mr-1" src="{{asset('infokiosk/images/id.png')}}" style="max-height: 40px; max-width: 50px" alt="e-register"> E-Kundalik</a></li>
                        <li><a href="{{route('admin.infokiosk.books')}}" class="nav-link"><img class="mb-2 mr-1" src="{{asset('infokiosk/images/search.png')}}" style="max-height: 40px; max-width: 50px" alt="e-register"> Qidiruv</a></li>
                        <li><a href="{{route('admin.infokiosk.books')}}" class="nav-link"><img class="mb-2 mr-1" src="{{asset('infokiosk/images/book.png')}}" style="max-height: 40px; max-width: 50px" alt="e-register"> Kitoblar</a></li>
                        <li><a href="services.html" class="nav-link"><img class="mb-2 mr-1" src="{{asset('infokiosk/images/envelope.png')}}" style="max-height: 40px; max-width: 50px" alt="e-register"> Yangiliklar</a></li>
                        <li><a href="contact.html" class="nav-link"><img class="mb-2 mr-1" src="{{asset('infokiosk/images/chat.png')}}" style="max-height: 40px; max-width: 50px" alt="e-register"> Bog'lanish</a></li>
                        <li><a href="blog.html" class="nav-link"><img class="mb-2 mr-1" src="{{asset('infokiosk/images/info.png')}}" style="max-height: 40px; max-width: 50px" alt="e-register"> ARM haqida</a></li>
                    </ul>
                </nav>
            </div>


        </div>
    </div>

</header>

<div class="hero" style="background-image: url('{{asset('infokiosk/images/live2.svg')}}');"></div>
@yield('content')


<script src="{{asset('js/admin-page/core/jquery.min.js')}}"></script>
<script src="{{asset('js/admin-page/core/popper.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('infokiosk/js/jquery.sticky.js')}}"></script>
<script src="{{asset('infokiosk/js/main.js')}}"></script>
<script src="{{asset('js/admin-page/core/sweetalert2.js')}}"> </script>
<script type="text/javascript" src="{{asset('kiosk/adapter.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kiosk/vue.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kiosk/instascan.min.js')}}"></script>
@section('footerScripts')
@show
</body>
</html>
