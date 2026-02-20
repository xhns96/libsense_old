<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('images/core/logo.png')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href={{asset('css/admin-login-page/bootstrap.min.css')}}>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin-login-page/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin-login-page/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin-login-page/hamburgers.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin-login-page/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin-login-page/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin-login-page/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            @if(Session::has('admin_profile_status'))
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-triangle"></i> Ushbu Admin uchun kirishga ruxsat etilmagan!
                    </div>
                </div>
            @endif
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('images/admin-page/admin_bg.png')}}" alt="IMG">
            </div>
            <form class="login100-form validate-form" method="POST" action="{{ route('admin.login.submit') }}">
				@csrf
                <span class="login100-form-title">
				    Xush kelibsiz!
				</span>

                <div class="wrap-input100 validate-input" data-validate = "Elektron po'chta manzilini to'g'ri kiriting!">
                    <input class="input100" type="text" id="email" name="email" autocomplete="off" value="{{ old('email') }}" placeholder="Elektron po'chta" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Parolni kiriting!">
                    <input type="password" class="input100" id="password" name="password" autocomplete="off" placeholder="Parol" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Kirish
                    </button>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="{{route('landing_page')}}">
                        Bosh oynaga qaytish
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="{{asset('js/admin-login-page/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('js/admin-login-page/popper.min.js')}}"></script>
<script src="{{asset('js/admin-login-page/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('js/admin-login-page/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('js/admin-login-page/tilt.jquery.min.js')}}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{asset('js/admin-login-page/main.js')}}"></script>

</body>
</html>
