@extends('layouts.app')
@section('content')
    <div class="d-flex flex-wrap" style="align-items: center;background: linear-gradient(180deg, rgba(84, 99, 255, 0.37) 0%, rgba(66, 82, 255, 0) 101.67%);">
        <div class="p-2 flex-fill text-center">
            <h1 class="font-weight-bold" style="font-size: 2em;">Make your voting event feel easy</h1>
            <p class="px-3">Planning easier, practical and faster. You can determine who can vote without breaking from fraud.</p>
            <div class="d-flex justify-content-center">
                <a type="button" class="btn btn-primary m-2" href="{{route('login')}}" >Get Started</a>
                <a type="button" class="btn btn-light border border-dark m-2" href="#learnFastVoting">Learn More</a>
            </div>
        </div>
        <div class="p-2 flex-fill text-center">
            <img class="img-fluid" src="{{asset('assets/undraw_voting_nvu7.svg')}}" alt="" style="align-items: center">
        </div>
    </div>
    <section class="container">
        <h2 class="text-center" id="learnFastVoting">Why must FastVoting ?</h2>
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
        <p style="text-align: justify;">Fastvoting is a website-based online election application that can help you organize election events or make decisions easily, quickly and avoid fraud. You can choose whomever you want to be a voter</p> --}}
    </section>
@endsection

