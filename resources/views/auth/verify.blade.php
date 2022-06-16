@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="fa-envelope fa-solid fa-xl"></i>
        <h1 class="m-0">Email Verification</h1>
    </div>
    <hr class="ruler">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <p>{{ __('Before proceeding, please check your email and click the verification link.') }}</p>
    <p>{{ __('If you did not receive the email, request a new link by click the button below.') }}</p>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block my-2" style="width:100%;">{{ __('Resend Email') }}</button>.
    </form>
</div>
@endsection
