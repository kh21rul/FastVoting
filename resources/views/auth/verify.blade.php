@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row">
        <div class="pt-2"><img class="img-fluid py-2" src="{{asset('assets/iconMail.png')}}" alt="iconMail"></div>
        <div class="p-2">
            <h2 style="font-size: 2em;">Check Your Mail</h2>
        </div>
    </div>
    <hr class="ruler">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email we have sent a for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block my-2" style="width:100%;">{{ __('click here to request another') }}</button>.
    </form>
</div>
@endsection
