@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vote Now</h2>
    <p style="margin-block-end:0.2%;">Closed : 25 June 2022 at 4 p.m</p>
    <hr>
    <div class="d-flex flex-wrap choiceCard">
        <div class="card choice" style="margin-bottom: 1rem;">
            <div class="card-head d-flex justify-content-center p-2" style="height: 75%"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="max-width: 100%"></div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-success" style="width: 25%">Vote</a>
            </div>
        </div>
                <div class="card choice" style="margin-bottom: 1rem;">
            <div class="card-head d-flex justify-content-center p-2" style="height: 75%"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="max-width: 100%"></div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-success" style="width: 25%">Vote</a>
            </div>
        </div>
                <div class="card choice" style="margin-bottom: 1rem;">
            <div class="card-head d-flex justify-content-center p-2" style="height: 75%"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="max-width: 100%"></div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-success" style="width: 25%">Vote</a>
            </div>
        </div>
    </div>
</div>
@endsection
