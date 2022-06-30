@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-0 col-lg-6 d-none d-lg-block p-4">
                <img src="{{ asset('assets/undraw_onboarding_re_6osc.png') }}" alt="Register" class="img-col" height="auto">
            </div>
            <div class="col-12 col-lg-6">
                <h1>Welcome back to <span class="text-primary">{{ config('app.name') }}</span></h1>
                <p class="description-text">We are happy you back - feel the ease of making elections  quickly and safely.</p>
                <form method="POST" action="{{ route('login') }}" class="mb-4">
                    @csrf
                    <div class="form-outline mb-3">
                        <label for="email" class="form-label">
                            <span>{{ __('Email') }}</span>
                            <span class="fw-bold text-danger">*</span>
                        </label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="your@email.xyz" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-outline mb-3">
                        <label for="password" class="form-label">
                            <span>{{ __('Password') }}</span>
                            <span class="fw-bold text-danger">*</span>
                        </label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password"/>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-outline mb-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                            <span><a class="app-link" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a></span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Login') }}</button>
                </form>
                <span>Don't have an account? <a href="{{ route('register') }}" class="app-link">Register Now</a></span>
            </div>
        </div>
    </div>
@endsection
