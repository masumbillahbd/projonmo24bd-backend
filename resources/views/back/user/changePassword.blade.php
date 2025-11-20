@extends('layouts.backend')
@section('title')
    Admin | Change Password
@endsection

@section('extra_css')
    <style type="text/css">
        .form-label {
            cursor: pointer;
        }
    </style>
@endsection


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-normal  my-1">Change Password</h4>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{route('user.password.update')}}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" id="togglePassword" for="password">Password <i
                                            class="far fa-eye"></i></label>
                                    <input class="form-control" id="password" type="password" minlength="8"
                                           name="password" placeholder="Password" autocomplete="off">
                                    <span
                                        class="text-danger">{{ $errors->has('password') ? $errors->first('password'):''}}</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" id="toggleConfPassword" for="password-confirm"
                                           for="password">Confirm Password <i class="far fa-eye"></i></label>
                                    <input class="form-control" id="password-confirm" type="password" minlength="8"
                                           name="confirm_password" placeholder="Confirm Password" autocomplete="off">
                                    <span
                                        class="text-danger">{{ $errors->has('confirm_password') ? $errors->first('confirm_password'):''}}</span>
                                </div>
                                <button type="submit" class="btn btn-success my-4">Update</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-5-->
            </div>
        </div>
    </main>
@endsection

@section('extra_js')
    <script type="text/javascript">
        const toggleCurrentPass = document.getElementById('togglePassword');
        const newPassword = document.getElementById('password');
        toggleCurrentPass.addEventListener('click', function (e) {
            const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            newPassword.setAttribute('type', type);
            var newPassClass = $('#togglePassword').attr('class');
            if (newPassClass == 'far fa-eye') {
                $('#togglePassword').removeClass('far fa-eye');
                $('#togglePassword').addClass('far fa-eye-slash');
            }
            if (newPassClass == 'far fa-eye-slash') {
                $('#togglePassword').removeClass('far fa-eye-slash');
                $('#togglePassword').addClass('far fa-eye');
            }
        });

        const toggleConfPass = document.getElementById('toggleConfPassword');
        const confPassword = document.getElementById('password-confirm');
        toggleConfPass.addEventListener('click', function (el) {
            const type = confPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confPassword.setAttribute('type', type);
            var confPassClass = $('#toggleConfPassword').attr('class');
            if (confPassClass == 'far fa-eye') {
                $('#toggleConfPassword').removeClass('far fa-eye');
                $('#toggleConfPassword').addClass('far fa-eye-slash');
            }
            if (confPassClass == 'far fa-eye-slash') {
                $('#toggleConfPassword').removeClass('far fa-eye-slash');
                $('#toggleConfPassword').addClass('far fa-eye');
            }
        });
    </script>
@endsection
