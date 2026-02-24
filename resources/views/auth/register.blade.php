@extends('layouts.book')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-6">
                            <img src="{{asset('images/admin-page/admin_bg.png')}}" alt="IMG" class="w-75">
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-center font-weight-bold">Tizimdan ro‘yxatdan o‘tish !</h4>
                            <p class="text-center font-weight-bolder" style="color: black;">Andijon mashinasozlik instituti <br>
                                Libsense tizimi
                            </p>
                            @if(Session::has('HEMIS_error'))
                                <div class="alert alert-danger text-center" role="alert">
                                HEMIS bazasida ma'lumot topib bolmadi
                                </div>
                            @endif
                            <div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="email" class="form-label">E-Mail manzil</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
                                            </div>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="*@gmail.com, *@mail.ru, *@umail.uz" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                        @error('email')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="passport_number" class="form-label">Pasport raqami</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-credit-card-2-front-fill"></i></span>
                                            </div>
                                            <input id="passport_number" type="text" class="form-control @error('passport_number') is-invalid @enderror" name="passport_number" placeholder="AA9999999" value="{{ old('passport_number') }}" required autocomplete="passport_number" autofocus>
                                        </div>
                                        @error('passport_number')
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="passport_pin" class="form-label">JSHSHIR-kod</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-credit-card-2-front-fill"></i></span>
                                            </div>
                                            <input id="passport_pin" type="text" class="form-control @error('passport_pin') is-invalid @enderror" name="passport_pin" placeholder="12345678901234" value="{{ old('passport_pin') }}" required autocomplete="passport_pin" autofocus>
                                        </div>
                                        @error('passport_pin')
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">Parol</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock-fill"></i></span>
                                            </div>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="*eng kamida 8ta belgi*" required autocomplete="current-password">
                                        </div>
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm" class="form-label">Parolni tasdiqlash</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock-fill"></i></span>
                                            </div>
                                            <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation" placeholder="Parolni takroran kiriting">
                                        </div>
                                        @error('password_confirmation')
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    Eslab qolish
                                                </label>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn btn-primary btn-block col-md-12">
                                                Ro‘yxatdan o‘tish <i class="bi bi-box-arrow-right"></i>
                                            </button>
                                           @if (Route::has('password.request'))
                                               <a class="btn btn-link" href="{{ route('password.request') }}">
                                                   Parolni unutdingizmi ?
                                               </a>
                                           @endif
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!---------------------- OLD REGISTER FORM ---------------------->

        {{-- <div class="col-md-8">
            <div class="card" style="border-radius: 25px;box-shadow: 1px 1px 15px white;">
                <div class="card-header" style="color: grey"><b>RO'YHATDAN O'TISH</b></div>

                <div class="card-body">
                    @if(Session::has('HEMIS_error'))
                        <div class="alert alert-danger text-center" role="alert">
                            HEMIS bazasida ma'lumot topib bolmadi
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail manzil</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="*@gmail.com, *@mail.ru, *@umail.uz" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passport_number" class="col-md-4 col-form-label text-md-right">Pasport seriya</label>

                            <div class="col-md-6">
                                <input id="passport_number" type="text" class="form-control @error('passport_number') is-invalid @enderror" name="passport_number" value="{{ old('passport_number') }}" placeholder="Pasport seriya va raqami" required autocomplete="passport_number">

                                @error('passport_number')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passport_pin" class="col-md-4 col-form-label text-md-right">JSHSHIR</label>

                            <div class="col-md-6">
                                <input id="passport_pin" type="text" class="form-control @error('passport_pin') is-invalid @enderror" name="passport_pin" value="{{ old('passport_pin') }}" placeholder="JSHSHIR-kod" required autocomplete="name">

                                @error('passport_number')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Parol</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="*eng kamida 8ta belgi*" required autocomplete="new-password">

                                @error('password')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Parolni tasdiqlash</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="parolni takroran kiriting" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Ro'yhatdan o'tish
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
@section('footerScripts')
    @parent
    <script src="{{asset("js/inputmask/jquery.inputmask.min.js")}}"></script>
    <script>
        $(document).ready(function () {
            $("#passport_number").inputmask("AA9999999");
            $("#passport_pin").inputmask("99999999999999");
        });
    </script>
@endsection
