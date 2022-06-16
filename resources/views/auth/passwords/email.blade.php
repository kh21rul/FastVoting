@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="fa-lock fa-solid fa-xl"></i>
        <h1 class="m-0">Reset Password</h1>
    </div>
    <p class="">Please enter your registered email and we will send a link to reset your password.</p>
    <hr class="ruler">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-outline mb-3">
            <label for="email" class="form-label">
                <span>{{ __('Email Address') }}</span>
                <span class="text-danger fw-bold">*</span>
            </label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="your@email.xyz" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="width:100%;">
            {{ __('Send Password Reset Link') }}
        </button>
    </form>
</div>
@endsection
