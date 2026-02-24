<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('infokiosk/fonts/icomoon/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/core/logo.png')}}">

    <link rel="stylesheet" href="{{asset('css/book-page/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/book-page/bootstrap.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('css/book-page/bootstrap.min.css')}}">--}}

    <!-- Style -->
    <link rel="stylesheet" href="{{asset('css/admin-page/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/book-page/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bi.css')}}">
    @section('headerStyles')
    @show
    <title>@yield('title','Kitoblar')</title>
</head>
<body>


<aside class="sidebar">
    <div class="toggle">
        <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
        </a>
    </div>
    <div class="side-inner">

        @guest
            <div class="nav-menu" style="font-size: 1.5rem">
                <ul>
                    <li ><a href="{{ route('landing_page') }}"><i class="bi bi-house-fill"></i> Bosh oyna</a></li>
                    <li ><a href="{{ route('book=>index') }}"><i class="bi bi-search"></i> Qidiruv tizimi</a></li>
                    <li ><a href="{{ route('login') }}"><i class="bi bi-door-closed"></i> Kirish</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}"><i class="bi bi-person-lines-fill"></i> Ro'yxatdan o'tish</a></li>
                    @endif
                </ul>
            </div>
        @else
            <div class="profile">
                @if($currentUser->user_profile_image != "")
                    <img src="{{$currentUser->user_profile_image}}" alt="Image" class="img-fluid">
                @else
                    <img src="{{asset('storage/user-profile-images')}}/{{$currentUser->user_profile_image ?? 'placeholder.png'}}" alt="Image" class="img-fluid">
                @endif
                <h3 class="name font-weight-bold" style="font-family: 'Source Serif Pro', serif; font-size: 1.3rem;">{{$currentUser->name}}</h3>
                <span class="font-weight-medium text-muted">Talaba</span>
            </div>

            <div class="counter d-flex justify-content-center">
                <!-- <div class="row justify-content-center"> -->
                <div class="col">
                    <strong class="number">@if($currentUser->user_borrow_count){{$currentUser->user_borrow_count}}@else{{'0'}}@endif</strong>
                    <span class="number-label text-muted">Buyurtmalar</span>
                </div>
                <div class="col">
                    <strong class="number">@if($currentUser->user_down_count){{$currentUser->user_down_count}}@else{{'0'}}@endif</strong>
                    <span class="number-label text-muted">Yuklashlar</span>
                </div>
                <!-- </div> -->
            </div>

            <div class="nav-menu">
                <ul>
                    <li class="active"><a href="{{route('landing_page')}}"><span class="icon-home mr-3"></span>Bosh oyna</a></li>
                    <li><a href="{{route('book=>profile')}}"><span class="icon-user mr-3"></span>Profil</a></li>
                    <li><a href="{{route('book=>index')}}"><span class="icon-search mr-3"></span>Qidiruv tizimi</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="icon-sign-out mr-3"></span>Chiqish</a></li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>


        @endguest

    </div>

</aside>
<main>
    <div class="site-section">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</main>



<script src="{{asset('js/book-page/new-book-page/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/book-page/new-book-page/popper.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/book-page/new-book-page/bootstrap.min.js')}}"></script>
<script src="{{asset('js/admin-page/core/sweetalert2.js')}}"></script>
<script src="{{asset('js/book-page/new-book-page/main.js')}}"></script>
@section('footerScripts')
@show
</body>
</html>
