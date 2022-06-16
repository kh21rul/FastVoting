@extends('layouts.app')
@section('content')
    <div class="row jumbotron py-4 mx-0 mb-4">
        <div class="subjumbotron col-md-12 col-lg-6 mb-4">
            <h1>Make your voting event feel easy</h1>
            <p>Planning easier, practical and faster. You can determine who can vote without breaking from fraud.</p>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <a type="button" class="btn btn-primary" href="{{ route('login') }}">Get Started</a>
                <a type="button" class="btn btn-light" href="{{ route('about') }}">About {{ config('app.name') }}</a>
            </div>
        </div>
        <div class="subjumbotron col-md-12 col-lg-6">
            <img class="img-col" src="{{ asset('assets/undraw_voting_nvu7.png') }}" alt="">
        </div>
    </div>
    <section class="container-home mb-5">
        <h2 class="text-center mb-3">Why must {{ config('app.name') }}?</h2>
        <div class="d-flex flex-wrap justify-content-center gap-4 text-center">
            <div class="card my-2 p-3" style="width: 16rem;">
                <div class="card-body">
                    <img class="img-fluid mb-3" src="{{asset('assets/undraw_onboarding_re_6osc.png')}}" alt="">
                    <span class="fs-5">Easier & practical</span>
                </div>
            </div>
            <div class="card my-2 p-3" style="width: 16rem;">
                <div class="card-body">
                    <img class="img-fluid mb-3" src="{{asset('assets/undraw_connected_re_lmq2.png')}}" alt="">
                    <span class="fs-5">Selectpicker</span>
                </div>
            </div>
            <div class="card my-2 p-3" style="width: 16rem;">
                <div class="card-body">
                    <img class="img-fluid mb-3" src="{{asset('assets/undraw_add_files_re_v09g.png')}}" alt="">
                    <span class="fs-5">Easy to add options</span>
                </div>
            </div>
        </div>
    </section>
@endsection
