@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-sm-6 d-none d-sm-block pr-5">
            <img src="./assets/undraw_onboarding_re_6osc.png"
              alt="Login image" class="w-100 py-3" style="object-fit: cover; object-position: center;">
          </div>
        <div class="col-sm-6">
          <div class="d-flex align-items-center justify-content-center">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <h2>Welcome back to</h2>
              <h2 style="color: #5463FF;">FastVoting</h2>
              <p class="description-text">Website-based online voting application</p>
              <div class="form-outline mb-4">
                <label for="email" class="form-label">{{ __('Email Address') }}<span style="color:red;font-weight:bold"> *</span></label>
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-outline mb-4">
                <label for="password" class="form-label">{{ __('Password') }}<span style="color:red;font-weight:bold"> *</span></label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div class="form-outline mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block" style="width:100%;">
                {{ __('Login') }}
              </button>
              <p class="pt-1 m-0">@if (Route::has('password.request'))<a class="link-info" href="{{ route('password.request') }}"> {{ __('Forgot password?') }}</a></p>
              <p>Don't have an account? <a href="{{ route('register') }}" class="link-info">Register here</a>@endif</p>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
