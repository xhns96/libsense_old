<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/core/logo.png')}}">
    <title>@yield('title','Kitoblar')</title>
    @section('headerStyles')
        <link rel="stylesheet" href="{{asset('css/bi.css')}}">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('css/book-page/heroic-features.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/admin-page/global.css')}}">
    @show
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top myNav">
    <div class="container">
        <a class="navbar-brand" href="{{route('landing_page')}}">
            <img src="{{asset('images/core/LogoWithText.png')}}" height="50" class="d-inline-block align-top" alt="">

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav ml-lg-auto" wfd-id="56">
                <li class="nav-item" wfd-id="59">
                    <a class="nav-link navLinks" href="{{route('book=>index')}}">
                        <i class="bi bi-journal-check"></i> Barcha adabiyotlar
                    </a>
                </li>
                <li class="nav-item" wfd-id="58">
                    <a class="nav-link navLinks" href="{{route('book=>profile')}}">
                        <i class="bi bi-bag"></i> Buyurtmalar
                    </a>
                </li>
                <li class="nav-item mr-5" wfd-id="57">
                    <a class="nav-link navLinks" href="">
                        <i class="bi bi-chat"></i> ARM hodimlari
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link navLinks" href="{{ route('login') }}">
                            <i class="bi bi-door-closed"></i> Kirish
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link navLinks" href="{{ route('register') }}">
                                <i class="bi bi-person-lines-fill"></i> Ro'yxatdan o'tish
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle navLinksImg" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{asset('storage/user-profile-images')}}/{{$currentUser->user_profile_image ?? 'placeholder.png'}}" class="s35 rounded-circle mr-1" alt=""> {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item navLinks" href="{{ route('book=>profile') }}">
                                <i class="bi bi-person-lines-fill"></i> Profil
                            </a>
                            <a class="dropdown-item navLinks" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                               <i class="bi bi-door-open"></i> Chiqish
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    @yield('content')
</div>

@section('footerScripts')
    <script src="{{asset('js/book-page/jquery.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/admin-page/core/sweetalert2.js')}}"></script>
@show
</body>
</html>
