@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="d-none d-xl-block align-self-center" style="width: 48%; top:50%;">
                <img src="./assets/undraw_onboarding_re_6osc.png" alt="register" class="align-middle" style="width: 90%">
            </div>
            <div class="d-md-w-100">
                <form method="POST" action="{{ route('register') }}" style="width: 100%;">
                    @csrf
                    <h2>Sign up to</h2>
                    <h2 style="color: #5463FF;">FastVoting</h2>
                    <p class="description-text">Become a member - feel the ease of making elections  quickly and safely</p>
                    <div class="form-outline mb-4">
                        <label for="name" class="form-label">{{ __('Name') }}<span style="color:red;font-weight:bold"> *</span></label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name"/>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">{{ __('Email Address') }}<span style="color:red;font-weight:bold"> *</span></label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email address"/>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">{{ __('Password') }}<span style="color:red;font-weight:bold"> *</span></label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password"/>
                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                    </div>
                        <div class="form-outline mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}<span style="color:red;font-weight:bold"> *</span></label>
                            <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Enter your confirm password"/>
                        </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" style="width: 25%">{{ __('Register') }}</button>
                    <p class="mt-2">Already have an account ? <a href="{{ route('login') }}" class="link-info">Login</a></p>
                </form>
            </div>
        </div>
      </div>
    </div>
@endsection
