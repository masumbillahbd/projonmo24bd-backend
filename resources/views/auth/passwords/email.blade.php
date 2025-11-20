@extends('layouts.app')
<style>
    .form-control:focus {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        border-color: 1px solid #dee2e6 !important;
        outline: 0;
        box-shadow: none !important;
    }
    .container{
        font-family: sans-serif;
    }
</style>
@section('content')
<div class="container">
    <div class="row min-vh-100 d-flex justify-content-center align-item-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <div class="">
                                <label for="email" class="text-md-end mb-2">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0 mt-2">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                                <a href="/" type="submit" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
