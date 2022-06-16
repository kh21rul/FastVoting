@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="fa-lock fa-solid fa-xl"></i>
        <h1 class="m-0">Create New Password</h1>
    </div>
    <p>Your new password must different from the old password.</p>
    <hr class="ruler">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-outline mb-3">
            <label for="email" class="form-label">
                <span>{{ __('Email Address') }}</span>
                <span class="text-danger fw-bold">*</span>
            </label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-outline mb-3">
            <label for="password" class="form-label">
                <span>{{ __('Password') }}</span>
                <span class="text-danger fw-bold">*</span>
            </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Make new password" autofocus>
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
                <span class="text-danger fw-bold">*</span>
            </label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter new password">
        </div>

        <button type="submit" class="btn btn-primary btn-block" style="width:100%;">
            {{ __('Reset Password') }}
        </button>
    </form>
</div>
@endsection
