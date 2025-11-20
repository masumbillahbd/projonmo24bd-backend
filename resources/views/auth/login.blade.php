<?php $settings = \App\Models\Setting::find(1); ?>

@extends('layouts.app')

<style>
    .card {
        background: #212b5b69 !important;
    }

    .login_page label {
        color: #fff;
    }

    .panel-heading {
        color: #333;
        background-color: #f5f5f5;
        border-color: #ddd;
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .login__page {
        font-family: sans-serif;
    }

    .welcome_url {
        font-size: 32px !important;
    }

    .forgot__url {
        color: #fff !important;
        margin-top: 13px;
        padding-right: 0;
        display: block;
        font-size: 12px;
        font-weight: 300;
        letter-spacing: .5px;
    }

    .login__brand {
        height: 70px;
        background: #fff;
        padding: 6px 10px;
        border-radius: 3px;
        margin-bottom: 20px;
    }


    .btn {
        font-size: 20px !important;
        margin-top: 15px;
    }
    .login__page .form-control{
        border-radius: 2px;
    }
    .login__page .form-group{
        margin-bottom: 25px !important;
    }
    .login__page .card{
        position: relative;
        z-index: 999;
    }
    .login__page .btn.btn-primary{
        margin-top: 0;
        border-radius: 2px;
        width: 177px;
        background: #ff7700 !important;
        border-color: #ff7700 !important;
    }
    .login__page .btn.btn-primary:hover{
        background: #e16900 !important;
        border-color: #e16900 !important;
    }

    /*view pass*/
    .pass__field .view__pass i {
        color: #9f9f9f;
    }
    .pass__field .view__pass {
        position: absolute;
        right: 9px;
        top: 11px;
        line-height: 1;
    }

    @media (max-width: 991px) {
        .welcome_login {
            font-size: 23px;
            margin-top: 14px;
        }

        .welcome_url {
            font-size: 20px !important;
            line-height: 1;
            margin-top: 4px;
            display: block;
        }

        .login__page .panel {
            width: 80%;
            margin: 0 auto;
        }
    }
</style>
@section('content')
    <div class="container login__page">

        <div class="login_page row d-flex justify-content-center align-item-center">

            <div class="col-md-4 col-lg-4 col-md-offset-4 col-10">
                @if($settings->logo)
                    <div class="text-center">
                        <img src="/{{ $settings-> logo }}" alt="{{ $settings->site }}" class="login__brand">
                    </div>
                @endif
                <div class="card" style="box-shadow: 1px 2px 14px -6px;">
                    <div class="panel-heading"><span><a href="/"
                                                        style="color: #000;text-decoration: none;font-family: sans-serif;">< Back</a></span><span
                                style="float: right; color: #000;font-family: sans-serif;">Login</span></div>
                    <div class="card-body">
                        @if(Session::has('danger'))
                            <div class="alert alert-danger show small ">
                                {{ Session::get('danger') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group mb-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="form-label">E-Mail </label>
                                    <input id="email" type="email" class="form-control" name="email"
                                    placeholder="E-Mail" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                            </div>


                            <div class="form-group mb-2">
                                <label for="password" class="form-label">Password</label>
                                <div class="pass__field position-relative">
                                    <input id="password" type="password" class="form-control" name="password"  placeholder="Password" aria-describedby="passwordHelp">
                                    <div class="view__pass">
                                        <span id="togglePassword" style="cursor: pointer;">
                                            <i class="fas fa-eye" id="eyeIcon"></i>
                                        </span>
                                    </div>
                                </div>

                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                    </button>
                                    <div class="  mb-3 pb-1  text-end">
                                        @if (Route::has('password.request'))
                                            <a class="forgot__url" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
