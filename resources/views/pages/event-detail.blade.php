@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="detail-event">Lorem Ipsum</h2>
    <div class="d-flex justify-content-start my-2">
        <a type="button" class="btn btn-success" style="margin-right:1%;" href="#">Edit Event</a>
        <a type="button" class="btn btn-danger" href="#">Delete Event</a>
    </div>
    <p class="card-text"><span><img class="img-fluid" src="{{asset('assets/Calendar.png')}}" alt=""></span> 25 June 2022 at 8 AM - 25 June 2022 at 5 PM</p>
    <div class="description-detailEvent">
        <h3>Description :</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sem ligula, dapibus nec odio facilisis, facilisis bibendum leo. Quisque laoreet vitae purus nec auctor.</p>
    </div>
    <div class="resultVote-detailEvent">
        <h3>Result Voting :</h3>
        <p>Voting hasn't started yet</p>
    </div>
    <div class="choice-detailEvent">
        <h3>Choice :</h3>
        <div class="d-flex flex-wrap choiceCard">
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
