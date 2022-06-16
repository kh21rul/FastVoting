@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-0 col-lg-6 d-none d-lg-block p-4">
                <img src="{{ asset('assets/undraw_onboarding_re_6osc.png') }}" alt="Register" class="img-col" height="auto">
            </div>
            <div class="col-12 col-lg-6">
                <h1>Sign up to <span class="text-primary">{{ config('app.name') }}</span></h1>
                <p class="description-text">Become a member - feel the ease of making elections  quickly and safely.</p>
                <form method="POST" action="{{ route('register') }}" class="mb-4">
                    @csrf
                    <div class="form-outline mb-3">
                        <label for="name" class="form-label">
                            <span>{{ __('Name') }}</span>
                            <span class="fw-bold text-danger">*</span>
                        </label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your Name"/>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="form-text">The length should be <strong>5 - 60 characters</strong>.</p>
                    </div>
                    <div class="form-outline mb-3">
                        <label for="email" class="form-label">
                            <span>{{ __('Email') }}</span>
                            <span class="fw-bold text-danger">*</span>
                        </label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="your@email.xyz"/>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="form-text">Use your active email. We will send a <strong>verification link</strong> to your email.</p>
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
                        <p class="form-text">Make your password at least <strong>8 characters</strong> long.</p>
                    </div>
                    <div class="form-outline mb-3">
                        <label for="password-confirm" class="form-label">
                            <span>{{ __('Confirm Password') }}</span>
                            <span class="fw-bold text-danger">*</span>
                        </label>
                        <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter your password"/>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Register') }}</button>
                </form>
                <span class="mt-2">Already have an account ? <a href="{{ route('login') }}" class="link-info">Login</a></span>
            </div>
        </div>
      </div>
    </div>
@endsection
