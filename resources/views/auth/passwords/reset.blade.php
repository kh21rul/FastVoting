@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row">
        <div class="pt-2"><img class="img-fluid" src="{{asset('assets/iconKunci.png')}}" alt=""></div>
        <div class="description-text p-2">
            <h2 style="font-size: 1.5em;">Create New Password</h2>
        </div>
    </div>
    <p>Your new password must differ from the previous</p>
    <hr class="ruler">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-outline mb-4">
            <label for="email" class="form-label">{{ __('Email Address') }}<span style="color:red;font-weight:bold"> *</span></label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label for="password" class="form-label">{{ __('Password') }}<span style="color:red;font-weight:bold"> *</span></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}<span style="color:red;font-weight:bold"> *</span></label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary btn-block" style="width:100%;">
            {{ __('Reset Password') }}
        </button>
    </form>
</div>
@endsection
