@extends('layouts.app')

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 d-none d-sm-block pr-5">
            <img src="./assets/undraw_onboarding_re_6osc.png"
              alt="Login image" class="w-100 py-3" style="object-fit: cover; object-position: center;">
          </div>

        <div class="col-sm-6 text-black">

          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <form method="POST" action="{{ route('login') }}" style="width: 23rem;">
                @csrf

              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

              <div class="form-outline mb-4">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror form-control-lg" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                @error('email')
                    <span class="invalid-feedback"          role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label class="form-label" for="email">{{ __('Email Address') }}</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <label class="form-label" for="password">{{ __('Password') }}</label>
              </div>

              <div class="row mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Login') }}</button>
              </div>

              <p class="small mb-5 pb-lg-2">@if (Route::has('password.request'))<a class="text-muted" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a></p>
              <p>Don't have an account? <a href="{{ route('register') }}" class="link-info">Register here</a>@endif</p>

            </form>

          </div>

        </div>
      </div>
    </div>
@endsection
