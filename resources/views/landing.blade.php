<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>Libsense</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('images/core/logo.png')}}" type="image/png">

    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="{{asset('css/landing-page/animate.css')}}">

    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{asset('css/landing-page/slick.css')}}">

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{asset('css/landing-page/LineIcons.css')}}">

    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="{{asset('css/landing-page/font-awesome.min.css')}}">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{asset('css/landing-page/bootstrap.min.css')}}">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{asset('css/landing-page/default.css')}}">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{asset('css/landing-page/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin-page/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/landing/landing.css')}}">

</head>

<body>
<!--[if IE]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->


<!--====== PRELOADER PART START ======-->

<div class="preloader">
    <div class="loader">
        <div class="ytp-spinner">
            <div class="ytp-spinner-container">
                <div class="ytp-spinner-rotator">
                    <div class="ytp-spinner-left">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                    <div class="ytp-spinner-right">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--====== PRELOADER PART ENDS ======-->

<!--====== HEADER PART START ======-->

<header class="header-area">
    <div class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{route('landing_page')}}">
                            <img src="{{asset('images/core/LogoWithText.png')}}" height="50" alt="Logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="page-scroll" href="#home">Bosh oyna</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#about">Tizim haqida</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#services">Imkoniyatlar</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="page-scroll" href="#pricing">Pricing</a>--}}
{{--                                </li>--}}
                                <li class="nav-item">
                                    <a class="page-scroll" href="#testimonial">Fikrlar</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="page-scroll" href="#blog">Blog</a>--}}
{{--                                </li>--}}
                                <li class="nav-item">
                                    <a class="page-scroll" href="#contact">Bog'lanish</a>
                                </li>
                            </ul>
                        </div> <!-- navbar collapse -->

                        <div class="navbar-btn d-none d-sm-inline-block">
                            <a class="main-btn" data-scroll-nav="0" href="{{route('book=>index')}}">Kitoblar</a>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- navbar area -->

    <div id="home" class="header-hero bg_cover d-lg-flex align-items-center">
        <div class="shape shape-1 animation1">
            <img src="{{asset('images/landing-page/shape-1.svg')}}" alt="shape">
        </div> <!-- shape -->
        <div class="shape shape-2 animation2">
            <img src="{{asset('images/landing-page/shape-2.svg')}}" alt="shape">
        </div> <!-- shape -->
        <div class="shape shape-3">
            <img src="{{asset('images/landing-page/shape-3.svg')}}" alt="shape">
        </div> <!-- shape -->

        <div class="shape shape-4 animation1">
            <img src="{{asset('images/landing-page/shape-1.svg')}}" alt="shape">
        </div> <!-- shape -->
        <div class="shape shape-5 animation2">
            <img src="{{asset('images/landing-page/shape-2.svg')}}" alt="shape">
        </div> <!-- shape -->
        <div class="shape shape-6">
            <img src="{{asset('images/landing-page/shape-3.svg')}}" alt="shape">
        </div> <!-- shape -->

        <div class="shape shape-7 animation1">
            <img src="{{asset('images/landing-page/shape-1.svg')}}" alt="shape">
        </div> <!-- shape -->
        <div class="shape shape-8 animation2">
            <img src="{{asset('images/landing-page/shape-2.svg')}}" alt="shape">
        </div> <!-- shape -->
        <div class="shape shape-9">
            <img src="{{asset('images/landing-page/shape-3.svg')}}" alt="shape">
        </div> <!-- shape -->

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10">
                    <div class="header-hero-content">
                        <h3 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">Axborot-resurs markazlari uchun <span>Libsense</span> tizimi</h3>
                        <p class="text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">Ushbu tizim yordamida o'zingiz ishlayotgan axborot - resurs markazini yangi pog'onaga ko'taring</p>
                        <a href="{{route('admin.dashboard')}}" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.2s">Hodimlar uchun</a>
                    </div> <!-- header hero content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
        <div class="header-hero-image d-flex justify-content-start align-items-center wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="1.7s">
            <div class="image">
{{--                <img src="{{asset('images/landing-page/banner.svg')}}" alt="hero">--}}
                <img src="{{asset('images/landing-page/landing-2.png')}}" alt="hero">
            </div>
        </div> <!-- header hero image -->
        <div class="header-shape d-none d-lg-block"></div>
    </div> <!-- header hero -->
</header>

<!--====== HEADER PART ENDS ======-->

<!--====== BRAND PART START ======-->

<section id="brand" class="brand-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="brand-title pb-30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                    <h4 class="title">Tizimdan foydalanayotgan OTMlar</h4>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ac">
                <div class="brand-wrapper d-flex flex-wrap justify-content-center">
                    <div class="single-brand wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
                        <img src="{{asset('images/andmi.jpg')}}" alt="brand">
                    </div> <!-- single brand -->
                    <div class="single-brand wow fadeIn" data-wow-duration="2s" data-wow-delay="0.3s">
                        <img src="{{asset('images/and_agrar.png')}}" alt="brand">
                    </div> <!-- single brand -->
                    <div class="single-brand wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">
                        <img src="{{asset('images/adu.png')}}" alt="brand">
                    </div> <!-- single brand -->
                    <div class="single-brand wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
                        <img src="{{asset('images/and_tibbiyot.png')}}" alt="brand">
                    </div> <!-- single brand -->
{{--                    <div class="single-brand wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">--}}
{{--                        <img src="{{asset('images/landing-page/brand-5.png')}}" alt="brand">--}}
{{--                    </div> <!-- single brand -->--}}
                </div> <!-- brand wrapper -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== BRAND PART ENDS ======-->

<!--====== ABOUT PART START ======-->

<section id="about" class="about-area pt-120">
    <div class="about-image d-flex align-items-xl-end align-items-center justify-content-end" >
        <img src="{{asset('images/landing-page/studying2.svg')}}" alt="About" class="wow fadeInLeftBig" style="max-height: 700px; max-width: 700px" data-wow-duration="2s" data-wow-delay="0.5s">
    </div>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-6">
                <div class="about-content wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="0.5s">
                    <div class="section-title">
                        <h5 class="sub-title">Tizim haqida</h5>
                        <h3 class="title">Ushbu timiz nafaqat hodimlariga, balki <span>Kitobxonlar</span> uchun ham qulaydir</h3>
                    </div> <!-- section title -->
                    <p class="text">Ushbu tizim siz ishlayotgan axborot - resurs markazini yangi pog'onaga ko'taradi. Tizimda kitobxonlar qatnovi QR kodga asoslangan bo'lib, kitobxon qatnovi elektron yuritiladi. </p>

                    <a class="main-btn" href="#">Read More</a>
                </div> <!-- about content -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== ABOUT PART ENDS ======-->

<!--====== SERVICES PART START ======-->

<section id="services" class="services-area pt-115 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center pb-20 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                    <h5 class="sub-title">Tizim imkoniyatlari</h5>
                    <h3 class="title"><span>Libsense</span> tizimi quyidagi imkoniyatlarga ega</h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-services mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.2s">
                    <div class="services-icon d-flex align-items-center justify-content-center">
                        <img src="{{asset('images/landing-page/service-icon-1.svg')}}" alt="service">
                    </div>
                    <div class="services-content">
                        <h4 class="services-title"><a href="#">Qulay interfeys</a></h4>
                        <p class="text" style="min-height: 142px">Tizim interfeysi intuitiv tushunarlik (ya'ni ushbu tizimga birinchi marotaba murojaat qilayotgan kitobxonlar hech kimni yordamisiz o'ziga kerakli ma'lumotni topa oladi ).</p>
                        <!-- <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a> -->
                    </div>
                </div> <!-- single services -->
            </div>
            <div class="col-lg-4 col-md-6 ">
                <div class="single-services mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
                    <div class="services-icon d-flex align-items-center justify-content-center">
                        <img src="{{asset('images/landing-page/service-icon-2.svg')}}" alt="service">
                    </div>
                    <div class="services-content">
                        <h4 class="services-title"><a href="#">Oson buyurtma</a></h4>
                        <p class="text">Tizimda "Masofaviy buyurtma"  imkoniyati mavjud bo'lib, kitobxonlar bevosita internet tarmog'i yordamida ixtiyoriy joydan turib o'ziga kerakli bo'lgan adabiyotni buyurtma qilishlari mumkin.</p>
                        <!-- <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a> -->
                    </div>
                </div> <!-- single services -->
            </div>
            <div class="col-lg-4 col-md-6 ">
                <div class="single-services mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.8s">
                    <div class="services-icon d-flex align-items-center justify-content-center">
                        <img src="{{asset('images/landing-page/service-icon-3.svg')}}" alt="service">
                    </div>
                    <div class="services-content">
                        <h4 class="services-title"><a href="#">Tez qidiruv</a></h4>
                        <p class="text" style="min-height: 142px">Endi kitobxon  "To'ldiruvchi qidiruv" tizimi yordamida juda tez o'ziga kerak bo'lgan adabiyotni topa oladi.</p>
                        <!-- <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a> -->
                    </div>
                </div> <!-- single services -->
            </div>
            <div class="col-lg-4 col-md-6 ">
                <div class="single-services mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.2s">
                    <div class="services-icon d-flex align-items-center justify-content-center">
                        <img src="{{asset('images/landing-page/service-icon-4.svg')}}" alt="service">
                    </div>
                    <div class="services-content">
                        <h4 class="services-title"><a href="#">QR kod</a></h4>
                        <p class="text" style="min-height: 142px">Tizim barcha kiritilgan adabiyotlar uchun avtomatik tarza QR kod tayyorlaydi va ushbu QR kod yordamida buyurtma qilishlari yoki yuklab olishlari mumkin.</p>
{{--                        <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a>--}}
                    </div>
                </div> <!-- single services -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-services mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
                    <div class="services-icon d-flex align-items-center justify-content-center">
                        <img src="{{asset('images/landing-page/service-icon-5.svg')}}" alt="service">
                    </div>
                    <div class="services-content">
                        <h4 class="services-title"><a href="#">Keng qamrov</a></h4>
                        <p class="text" style="min-height: 142px">Kitobxon qidiruv tizimi yordamida nafaqat o'zi o'qiyotgan OTM ARM bazasidagi
                            resurslardan, balki tizimga bog'langan barcha OTM ARM lari resurslaridan
                            foydalana oladilar.
                        </p>
{{--                        <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a>--}}
                    </div>
                </div> <!-- single services -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-services mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.8s">
                    <div class="services-icon d-flex align-items-center justify-content-center">
                        <img src="{{asset('images/landing-page/service-icon-6.svg')}}" alt="service">
                    </div>
                    <div class="services-content">
                        <h4 class="services-title"><a href="#">ARM Statistikasi</a></h4>
                        <p class="text" style="min-height: 142px">Statistik ma’lumotlarni yig‘ish, qayta ishlash va elektron xisob yuritish
                        mumkin.</p>
{{--                        <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a>--}}
                    </div>
                </div> <!-- single services -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== SERVICES PART ENDS ======-->

<!--====== PRICHING PART START ======-->

<section id="pricing" class="pricing-area pt-115 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="counter">
                    <span class="counter-value">{{$allBooks}}</span>
                    <h3>Adabiyotlar soni</h3>
                    <div class="counter-icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="counter magenta">
                    <span class="counter-value">{{$allEBooks}}</span>
                    <h3>Elektron adabiyotlar soni</h3>
                    <div class="counter-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="counter purple">
                    <span class="counter-value">{{$allUsers}}</span>
                    <h3>Foydalanuvchilar soni</h3>
                    <div class="counter-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="counter blue">
                    <span class="counter-value">0</span>
                    <h3>Buyurtmalar soni</h3>
                    <div class="counter-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== PRICHING PART ENDS ======-->

<!--====== TESTIMONIAL PART START ======-->

<section id="testimonial" class="testimonial-area pt-70">
    <div class="testimonial-shape-1 d-none d-md-block">
        <img src="{{asset('images/landing-page/testimonial-shape-1.svg')}}" alt="shape">
    </div> <!-- testimonial shape -->

    <div class="shape shape-1 animation2">
        <img src="{{asset('images/landing-page/shape-2.svg')}}" alt="shape">
    </div> <!-- shape -->
    <div class="shape shape-2 animation2">
        <img src="{{asset('images/landing-page/shape-2.svg')}}" alt="shape">
    </div> <!-- shape -->
    <div class="shape shape-3 animation1">
        <img src="{{asset('images/landing-page/shape-1.svg')}}" alt="shape">
    </div> <!-- shape -->
    <div class="shape shape-4">
        <img src="{{asset('images/landing-page/shape-3.svg')}}" alt="shape">
    </div> <!-- shape -->
    <div class="shape shape-5 animation2">
        <img src="{{asset('images/landing-page/shape-2.svg')}}" alt="shape">
    </div> <!-- shape -->
    <div class="shape shape-6">
        <img src="{{asset('images/landing-page/shape-3.svg')}}" alt="shape">
    </div> <!-- shape -->
    <div class="shape shape-7">
        <img src="{{asset('images/landing-page/shape-3.svg')}}" alt="shape">
    </div> <!-- shape -->

    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-5">
                <div class="testimonial-author mt-50">
                    <div class="author-image author-1 animation3">
                        <img src="{{asset('images/landing-page/author-2.jpg')}}" alt="author">
                    </div> <!-- author image -->
                    <div class="author-image author-2 animation3">
                        <img src="{{asset('images/landing-page/author-3.jpg')}}" alt="author">
                    </div> <!-- author image -->
                    <div class="author-image author-3 animation3">
                        <img src="{{asset('images/landing-page/author-4.jpg')}}" alt="author">
                    </div> <!-- author image -->
                    <div class="author-image author-4 animation3">
                        <img src="{{asset('images/landing-page/author-5.jpg')}}" alt="author">
                    </div> <!-- author image -->
                    <div class="author-image author-5 animation3">
                        <img src="{{asset('images/landing-page/author-6.jpg')}}" alt="author">
                    </div> <!-- author image -->

                    <div class="testimonial-author-wrapper">
                        <div class="testimonial-quote d-flex align-items-center justify-content-center">
                            <img src="{{asset('images/landing-page/quote.svg')}}" alt="quote">
                        </div>

                        <div class="testimonial-author-slider">
                            <div class="single-author">
                                <img src="{{asset('images/landing-page/author-1.jpg')}}" alt="author">
                            </div>
                            <div class="single-author">
                                <img src="{{asset('images/landing-page/author-2.jpg')}}" alt="author">
                            </div>
                            <div class="single-author">
                                <img src="{{asset('images/landing-page/author-3.jpg')}}" alt="author">
                            </div>
                        </div>
                    </div>
                </div> <!-- testimonial author -->
            </div>
            <div class="col-xl-6 col-lg-7">
                <div class="testimonial-wrapper mt-50 wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="0.5s">
                    <div class="section-title">
                        <h5 class="sub-title">Testimonials</h5>
                        <h3 class="title">See What's Our <span>Client Says About Us</span></h3>
                    </div> <!-- section title -->
                    <div class="testimonial-content">
                        <div class="single-testimonial mt-35">
                            <p class="text">Lorem ipsum dolor sitrg amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna iquyam erat, sed diam voluptua. At vero eos et accusam et justo dudolores etea rebum. Stet clita kasd gubergren, no sea takimata sanctus esth Lorem ipsum dolor sit amet.</p>
                            <h4 class="holder-name">Jessica John <span>/ Creative Designer</span></h4>
                        </div> <!-- single testimonial -->

                        <div class="single-testimonial mt-35">
                            <p class="text">Lorem ipsum dolor sitrg amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna iquyam erat, sed diam voluptua. At vero eos et accusam et justo dudolores etea rebum. Stet clita kasd gubergren, no sea takimata sanctus esth Lorem ipsum dolor sit amet.</p>
                            <h4 class="holder-name">Michel Smith <span>/ Entrepreneur</span></h4>
                        </div> <!-- single testimonial -->

                        <div class="single-testimonial mt-35">
                            <p class="text">Lorem ipsum dolor sitrg amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna iquyam erat, sed diam voluptua. At vero eos et accusam et justo dudolores etea rebum. Stet clita kasd gubergren, no sea takimata sanctus esth Lorem ipsum dolor sit amet.</p>
                            <h4 class="holder-name">Sara Smith <span>/ Startup Founder</span></h4>
                        </div> <!-- single testimonial -->
                    </div> <!-- testimonial content -->
                </div> <!-- testimonial wrapper -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== TESTIMONIAL PART ENDS ======-->

<!--====== BLOG PART START ======-->

<section id="blog" class="blog-area pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center pb-20 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                    <h5 class="sub-title">Blog</h5>
                    <h3 class="title">Learn More From<br> Our <span>Latest News</span></h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7">
                <div class="single-blog mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.2s">
                    <div class="blog-image">
                        <img src="{{asset('images/landing-page/blog-1.jpg')}}" alt="blog">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="author">
                                <img src="{{asset('images/landing-page/author-1.jpg')}}" alt="author">
                            </div>
                            <ul class="blog-list">
                                <li><a href="#">Abraham</a></li>
                                <li><a href="#">15 Feb, 2022</a></li>
                            </ul>
                        </div>
                        <div class="blog-text">
                            <h4 class="blog-title"><a href="#">Business Groth & Analysis</a></h4>
                            <p class="text">Lorem ipsum dolor sit aconsect dipisicing elit, sed do eiusmod to incididunt uabore etdolore magna aliqua.</p>
                            <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a>
                        </div>
                    </div>
                </div> <!-- single blog -->
            </div>
            <div class="col-lg-4 col-md-7">
                <div class="single-blog mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
                    <div class="blog-image">
                        <img src="{{asset('images/landing-page/blog-2.jpg')}}" alt="blog">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="author">
                                <img src="{{asset('images/landing-page/author-2.jpg')}}" alt="author">
                            </div>
                            <ul class="blog-list">
                                <li><a href="#">Jesika Jon</a></li>
                                <li><a href="#">15 Feb, 2022</a></li>
                            </ul>
                        </div>
                        <div class="blog-text">
                            <h4 class="blog-title"><a href="#">Digital Market Analysis</a></h4>
                            <p class="text">Lorem ipsum dolor sit aconsect dipisicing elit, sed do eiusmod to incididunt uabore etdolore magna aliqua.</p>
                            <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a>
                        </div>
                    </div>
                </div> <!-- single blog -->
            </div>
            <div class="col-lg-4 col-md-7">
                <div class="single-blog mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.8s">
                    <div class="blog-image">
                        <img src="{{asset('images/landing-page/blog-3.jpg')}}" alt="blog">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <div class="author">
                                <img src="{{asset('images/landing-page/author-3.jpg')}}" alt="author">
                            </div>
                            <ul class="blog-list">
                                <li><a href="#">Michel Smith</a></li>
                                <li><a href="#">15 Feb, 2022</a></li>
                            </ul>
                        </div>
                        <div class="blog-text">
                            <h4 class="blog-title"><a href="#">Creative Product Analysis</a></h4>
                            <p class="text">Lorem ipsum dolor sit aconsect dipisicing elit, sed do eiusmod to incididunt uabore etdolore magna aliqua.</p>
                            <a class="more" href="#"><span class="line-1"></span> Read More <span class="line-2"></span></a>
                        </div>
                    </div>
                </div> <!-- single blog -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== BLOG PART ENDS ======-->

<!--====== CONTACT PART START ======-->

<section id="contact" class="contact-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="contact-content wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="section-title">
                        <h5 class="sub-title">Contact</h5>
                        <h3 class="title">Request A Free Quote or <span>Contact Us</span></h3>
                    </div> <!-- section title -->
                    <p class="text">Lorem ipsum dolor sitrg amet, consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna iquyam erat, sed diam voluptua.</p>
                </div> <!-- contact -->
                <div class="contact-form wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.6s">
                    <form id="contact-form" action="assets/contact.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="single-form">
                                    <input type="text" name="name" placeholder="Name">
                                </div> <!-- single form -->
                            </div>
                            <div class="col-md-6">
                                <div class="single-form">
                                    <input type="email" name="email" placeholder="Email">
                                </div> <!-- single form -->
                            </div>
                            <div class="col-md-12">
                                <div class="single-form">
                                    <textarea name="massage" placeholder="Message"></textarea>
                                </div> <!-- single form -->
                            </div>
                            <p class="form-message"></p>
                            <div class="col-md-12">
                                <div class="single-form">
                                    <button class="main-btn">Submit</button>
                                </div> <!-- single form -->
                            </div>
                        </div> <!-- row -->
                    </form>
                </div> <!-- contact form -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="contact-image d-flex align-items-center wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="0.5s">
        <div class="image">
            <img src="{{asset('images/landing-page/contact.svg')}}" alt="contact">
        </div>
    </div> <!-- contact image -->
</section>

<!--====== CONTACT PART ENDS ======-->

<!--====== FOOTER PART START ======-->

<section id="footer" class="footer-area ">
    <div class="footer-shape-1">
        <img src="{{asset('images/landing-page/footer-shape-1.svg')}}" alt="footer">
    </div> <!-- footer shape -->
    <div class="container">
        <div class="footer-widget pt-70 pb-120">
            <div class="row">
                <div class="col-lg-3 col-md-5 order-md-1 order-lg-1">
                    <div class="footer-address mt-50 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
                        <a href="#" class="logo">
                            <img src="{{asset('images/landing-page/logo.svg')}}" alt="Logo">
                        </a>
                        <p class="text">Tel : +998 97 596 6964</p>
                        <p class="text">rustamkurganov96@gmail.com</p>
                        <p class="text">Manzil: 170100, Andijon sh, Boburshox 56</p>
                    </div> <!-- footer address -->
                </div>
                <div class="col-lg-5 col-md-10 order-md-3 order-lg-2">
                    <div class="footer-link-wrapper d-flex ">
                        <div class="footer-link mt-45  wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="footer-title">
                                <h4 class="title">Quick Link</h4>
                            </div>
                            <ul class="link mt-35">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Pricing</a></li>

                            </ul>
                        </div> <!-- footer link -->
                        <div class="footer-link mt-45 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">
                            <div class="footer-title">
                                <h4 class="title">Help & Support</h4>
                            </div>
                            <ul class="link mt-35">
                                <li><a href="#">Case Studies</a></li>
                                <li><a href="#">Work Process</a></li>
                                <li><a href="#">Resource</a></li>
                                <li><a href="#">Terms & Condition</a></li>
                            </ul>
                        </div> <!-- footer link -->
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-4 col-md-7 order-md-2 order-lg-3">
                    <div class="footer-subscribe wow fadeIn" data-wow-duration="2s" data-wow-delay="0.8s">
                        <div class="subscribe-content mt-45">
                            <div class="footer-title">
                                <h4 class="title">Subscribe Now</h4>
                                <p class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam. </p>
                            </div>
                        </div>
                        <div class="subscribe-form mt-40">
                            <input type="text" placeholder="example@gmail.com">
                            <button class="main-btn">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- footer widget -->
        <div class="footer-copyright d-md-flex justify-content-between">
            <div class="copyright-social d-flex justify-content-center justify-content-md-start">
                <span>Follow Us on</span>
                <ul class="social">
                    <li><a href="#"><i class="lni-facebook"></i></a></li>
                    <li><a href="#"><i class="lni-twitter"></i></a></li>
                    <li><a href="#"><i class="lni-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="copyright-text">
                <p class="text">Designed and Developed by <a href="http://andmiedu.uz" rel="nofollow">AndMI, Rustam Kurganov</a></p>
            </div>
        </div>
    </div> <!-- container -->
    <div class="footer-shape-2">
        <img src="{{asset('images/landing-page/footer-shape-2.svg')}}" alt="footer">
    </div> <!-- footer shape -->
</section>

<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TOP TOP PART START ======-->

<a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

<!--====== BACK TOP TOP PART ENDS ======-->

<!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-"></div>
            </div>
        </div>
    </section>
-->

<!--====== PART ENDS ======-->




<!--====== Jquery js ======-->
<script src="{{asset('js/landing-page/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('js/landing-page/vendor/modernizr-3.7.1.min.js')}}"></script>

<!--====== Bootstrap js ======-->
<script src="{{asset('js/landing-page/popper.min.js')}}"></script>
<script src="{{asset('js/landing-page/bootstrap.min.js')}}"></script>

<!--====== Slick js ======-->
<script src="{{asset('js/landing-page/slick.min.js')}}"></script>

<!--====== Scrolling Nav js ======-->
<script src="{{asset('js/landing-page/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/landing-page/scrolling-nav.js')}}"></script>

<!--====== Ajax Contact js ======-->
<script src="{{asset('js/landing-page/ajax-contact.js')}}"></script>

<!--====== wow js ======-->
<script src="{{asset('js/landing-page/wow.min.js')}}"></script>

<!--====== Main js ======-->
<script src="{{asset('js/landing-page/main.js')}}"></script>

<script src="{{asset('js/landing/landing.js')}}"></script>

</body>

</html>
