@extends('auth.layouts.app')

@section('content')
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-6 col-12">
            <div id="auth-left">
                <h1 class="auth-title">{{ __('Login') }}</h1>
                <p class="auth-subtitle mb-5">

                </p>

                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" id="email" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <!-- <div class="form-control-icon">
                            <i class="bi bi-user"></i>
                        </div> -->

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                        <!-- <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div> -->
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <button type="submit" name="soumettre" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">{{ __('Login') }}</button>
                </form>
                <div class="text-center mt-5 text-md fs-4">
                    @if (Route::has('register'))
                    <p class="text-gray-600">Don't have an account?
                        <a href="auth-register.html">
                            {{ __('Register') }}
                        </a>
                    </p>
                    @endif
                    @if (Route::has('password.request'))
                    <p>
                        <a href="auth-forgot-password.html">{{ __('Forgot Password?') }}</a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

</div>
@endsection