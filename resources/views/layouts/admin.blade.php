<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <!-- Favicon icon -->
    @section('headerStyles')
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/core/logo.png')}}">
    <title>@yield('title', 'Librarium')</title>
    <!-- Custom CSS -->
    <link href="{{asset('css/admin-page/core/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin-page/core/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin-page/core/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{asset('css/admin-page/core/style-core.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin-page/global.css')}}">
    @show
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <img src="{{asset('images/loading_lamp.gif')}}" height="200" width="200" alt="Loader">
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md">
            <div class="navbar-header" data-logobg="skin6">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-brand">
                    <!-- Logo icon -->
                    <a href="index.html">
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="{{asset('images/core/LogoWithText.png')}}" height="50" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{asset('images/core/LogoWithText.png')}}" height="50" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                        <!-- dark Logo text -->
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                   data-toggle="collapse" data-target="#navbarSupportedContent"
                   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                        class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                    <!-- Notification -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                           id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <span><i data-feather="bell" class="svg-icon"></i></span>
{{--                            <span class="badge badge-primary notify-no rounded-circle">5</span>--}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                            <ul class="list-style-none">
                                <li>
                                    <div class="message-center notifications position-relative">
                                        <!-- Message -->
                                        <a href="javascript:void(0)"
                                           class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                            <div class="btn btn-danger rounded-circle btn-circle"><i
                                                    data-feather="airplay" class="text-white"></i></div>
                                            <div class="w-75 d-inline-block v-middle pl-2">
                                                <h6 class="message-title mb-0 mt-1">Luanch Admin</h6>
                                                <span class="font-12 text-nowrap d-block text-muted">Just see
                                                        the my new
                                                        admin!</span>
                                                <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)"
                                           class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success text-white rounded-circle btn-circle"><i
                                                        data-feather="calendar" class="text-white"></i></span>
                                            <div class="w-75 d-inline-block v-middle pl-2">
                                                <h6 class="message-title mb-0 mt-1">Event today</h6>
                                                <span
                                                    class="font-12 text-nowrap d-block text-muted text-truncate">Just
                                                        a reminder that you have event</span>
                                                <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)"
                                           class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-info rounded-circle btn-circle"><i
                                                        data-feather="settings" class="text-white"></i></span>
                                            <div class="w-75 d-inline-block v-middle pl-2">
                                                <h6 class="message-title mb-0 mt-1">Settings</h6>
                                                <span
                                                    class="font-12 text-nowrap d-block text-muted text-truncate">You
                                                        can customize this template
                                                        as you want</span>
                                                <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)"
                                           class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-primary rounded-circle btn-circle"><i
                                                        data-feather="box" class="text-white"></i></span>
                                            <div class="w-75 d-inline-block v-middle pl-2">
                                                <h6 class="message-title mb-0 mt-1">Pavan kumar</h6> <span
                                                    class="font-12 text-nowrap d-block text-muted">Just
                                                        see the my admin!</span>
                                                <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                                        <strong>Check all notifications</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- End Notification -->
                    <!-- ============================================================== -->
                    <!-- create new -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="settings" class="svg-icon"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="javascript:void(0)">
                            <div class="customize-input">
                                <select
                                    class="custom-select form-control bg-white custom-radius custom-shadow border-0" disabled>
                                    <option value="uz" selected>UZ</option>
                                    <option value="ru">RU</option>
                                </select>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="javascript:void(0)">
                            <form>
                                <div class="customize-input">
                                    <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                           type="search" placeholder="Search" aria-label="Search">
                                    <i class="form-control-icon" data-feather="search"></i>
                                </div>
                            </form>
                        </a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('storage/admin-profile-images/')}}/{{$currentAdmin->admin_profile_image ?? 'def_avatar_image.png'}}" alt="user" class="rounded-circle"
                                 width="40">
                            <span class="ml-2 d-none d-lg-inline-block"><span>Xush kelibsiz,</span> <span
                                    class="text-dark">{{$currentAdmin->name}}</span> <i data-feather="chevron-down"
                                                                          class="svg-icon"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                            <a class="dropdown-item" href="{{route('admin.profile')}}">
                                <i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                                Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i data-feather="log-out" class="feather-icon mr-1"></i> Chiqish
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                            <i data-feather="activity" class="feather-icon"></i>
                            <span class="hide-menu">Statistika</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
{{--                    <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>--}}

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('admin.profile')}}" aria-expanded="false">
                            <i data-feather="user" class="feather-icon"></i>
                            <span class="hide-menu">Men haqimda</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="#" aria-expanded="false">
                            <i data-feather="message-square" class="feather-icon"></i>
                            <span class="hide-menu mr-3">Chat</span> <span class="badge badge-pill badge-danger">Tez orada</span>
                        </a>
                    </li>

                    <li class="list-divider"></li>
{{--                    <li class="nav-small-cap"><span class="hide-menu">Components</span></li>--}}
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.settings')}}" aria-expanded="false">
                            <i data-feather="settings" class="feather-icon"></i>
                            <span class="hide-menu">Sozlamalar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.employee')}}" aria-expanded="false">
                            <i data-feather="shield" class="feather-icon"></i>
                            <span class="hide-menu">Barcha hodimlar</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.add_book')}}" aria-expanded="false">
                            <i data-feather="book" class="feather-icon"></i>
                            <span class="hide-menu">Adabiyot qo'shish</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.all_books')}}" aria-expanded="false">
                            <i data-feather="book-open" class="feather-icon"></i>
                            <span class="hide-menu">Barcha adabiyotlar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.all_ebooks')}}" aria-expanded="false">
                            <i data-feather="download-cloud" class="feather-icon"></i>
                            <span class="hide-menu">Elektron adabiyotlar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.reports')}}" aria-expanded="false">
                            <i data-feather="file-text" class="feather-icon"></i>
                            <span class="hide-menu mr-1">Hisobot</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.all_orders')}}" aria-expanded="false">
                            <i data-feather="shopping-cart" class="feather-icon"></i>
                            <span class="hide-menu">Barcha buyurtmalar</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.new_users')}}" aria-expanded="false">
                            <i data-feather="user-plus" class="feather-icon"></i>
                            <span class="hide-menu">Yangi kitobxonlar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.all_users')}}" aria-expanded="false">
                            <i data-feather="users" class="feather-icon"></i>
                            <span class="hide-menu">Barcha kitobxonlar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.borrowed_users')}}" aria-expanded="false">
                            <i data-feather="user-x" class="feather-icon"></i>
                            <span class="hide-menu">Qarzdor kitobxonlar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.borrowed_history')}}" aria-expanded="false">
                            <i data-feather="archive" class="feather-icon"></i>
                            <span class="hide-menu">Fond jurnali</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="#" aria-expanded="false">
                            <i data-feather="list" class="feather-icon"></i>
                            <span class="hide-menu mr-1">Kataloglashtirish</span> <span class="badge badge-pill badge-danger">Tez orada</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="#" aria-expanded="false">
                            <i data-feather="paperclip" class="feather-icon"></i>
                            <span class="hide-menu mr-1">ARM faoliyati</span> <span class="badge badge-pill badge-danger">Tez orada</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.kundalik')}}" aria-expanded="false">
                            <i data-feather="book-open" class="feather-icon"></i>
                            <span class="hide-menu mr-1">Kundalik</span>
                        </a>
                    </li>
                    <li class="sidebar-item mb-5">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.infokiosk.index')}}" aria-expanded="false">
                            <i data-feather="monitor" class="feather-icon"></i>
                            <span class="hide-menu mr-1">Infokiosk</span>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
{{--        <div class="page-breadcrumb">--}}
{{--            <div class="row">--}}
{{--                <div class="col-7 align-self-center">--}}
{{--                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning Jason!</h3>--}}
{{--                    <div class="d-flex align-items-center">--}}
{{--                        <nav aria-label="breadcrumb">--}}
{{--                            <ol class="breadcrumb m-0 p-0">--}}
{{--                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>--}}
{{--                                </li>--}}
{{--                            </ol>--}}
{{--                        </nav>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-5 align-self-center">--}}
{{--                    <div class="customize-input float-right">--}}
{{--                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">--}}
{{--                            <option selected>Aug 19</option>--}}
{{--                            <option value="1">July 19</option>--}}
{{--                            <option value="2">Jun 19</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center text-muted">
            Ushbu tizim, axborot - resurs markazlari uchun <i class="fa fa-heart" data-toggle="tooltip" data-placement="top" data-original-title="Mehr."></i> bilan tayyorlangan.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
@section('footerScripts')
<script src="{{asset('js/admin-page/core/jquery.min.js')}}"> </script>
<script src="{{asset('js/admin-page/core/popper.min.js')}}"> </script>
<script src="{{asset('js/admin-page/core/bootstrap.min.js')}}"> </script>
<script src="{{asset('js/admin-page/core/app-style-switcher.js')}}"> </script>
<script src="{{asset('js/admin-page/core/feather.min.js')}}"> </script>
<script src="{{asset('js/admin-page/core/perfect-scrollbar.jquery.min.js')}}"> </script>
<script src="{{asset('js/admin-page/core/sidebarmenu.js')}}"> </script>
<script src="{{asset('js/admin-page/core/sweetalert2.js')}}"> </script>
<script src="{{asset('js/admin-page/core/custom.min.js')}}"> </script>
@show
</body>
</html>
