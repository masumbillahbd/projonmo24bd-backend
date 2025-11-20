@extends('layouts.app')

@section('content')
<style>
    .card{
        z-index: 99;
    }
</style>
<div class="container">
    <div class="row min-vh-100 d-flex justify-content-center align-item-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}  <i class="far fa-eye" id="togglePassword"></i> </label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }} <i class="far fa-eye" id="toggleConfPassword"></i></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class=" mb-0">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  const toggleCurrentPass = document.getElementById('togglePassword');
  const newPassword = document.getElementById('password');
  toggleCurrentPass.addEventListener('click', function (e) {
    const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
    newPassword.setAttribute('type', type);
    var newPassClass = $('#togglePassword').attr('class'); 
    if(newPassClass == 'far fa-eye'){
      $('#togglePassword').removeClass('far fa-eye');
      $('#togglePassword').addClass('far fa-eye-slash');
    }
    if(newPassClass == 'far fa-eye-slash'){
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
    if(confPassClass == 'far fa-eye'){
      $('#toggleConfPassword').removeClass('far fa-eye');
      $('#toggleConfPassword').addClass('far fa-eye-slash');
    }
    if(confPassClass == 'far fa-eye-slash'){
      $('#toggleConfPassword').removeClass('far fa-eye-slash');
      $('#toggleConfPassword').addClass('far fa-eye');
    }
  });
</script>

@endsection
