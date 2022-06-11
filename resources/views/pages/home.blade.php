@extends('layouts.app')
@section('content')
    <div class="d-flex jumbotron">
        <div class="p-2 text-center subjumbotron">
            <h1 class="font-weight-bold" style="font-size: 2em;background-color: transparent;">Make your voting event feel easy</h1>
            <p class="px-3" style="background-color: transparent;">Planning easier, practical and faster. You can determine who can vote without breaking from fraud.</p>
            <div class="d-flex justify-content-center" style="background-color: transparent;">
                <a type="button" class="btn btn-primary m-1" href="{{route('login')}}">Get Started</a>
                <a type="button" class="btn btn-light border border-dark m-1" href="{{route('about')}}">About {{ config('app.name') }}</a>
            </div>
        </div>
        <div class="p-2 text-center subjumbotron" style="width:50%;">
            <img class="img-fluid imgJumbotron" src="{{asset('assets/undraw_voting_nvu7.png')}}" alt="" style="align-items: center; background-color: transparent;">
        </div>
    </div>
    <section class="container-home mb-5">
        <h2 class="text-center">Why must {{ config('app.name') }}?</h2>
        <div class="d-flex flex-wrap justify-content-around text-center">
            <div class="card my-2" style="width: 15rem;height: 15rem;">
                <div class="card-body">
                    <img class="img-fluid" src="{{asset('assets/undraw_onboarding_re_6osc.png')}}" alt="">
                    <h5 class="card-text">Easier & practical</h5>
                </div>
            </div>
            <div class="card my-2" style="width: 15rem;height: 15rem;">
                <div class="card-body">
                    <img class="img-fluid" src="{{asset('assets/undraw_connected_re_lmq2.png')}}" alt="">
                    <h5 class="card-text">Selectpicker</h5>
                </div>
            </div>
            <div class="card my-2" style="width: 15rem;height: 15rem;">
                <div class="card-body">
                    <img class="img-fluid" src="{{asset('assets/undraw_add_files_re_v09g.png')}}" alt="">
                    <h5 class="card-text">Easy to add options</h5>
                </div>
            </div>
        </div>
        {{-- <h2 class="text-center">About FastVosting ?</h2>
        <p style="text-align: justify;">{{ config('app.name') }} is a website-based online election application that can help you organize election events or make decisions easily, quickly and avoid fraud. You can choose whomever you want to be a voter</p> --}}
    </section>
@endsection
