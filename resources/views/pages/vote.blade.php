@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vote Now</h2>
    <p style="margin-block-end:0.2%;">Closed : 25 June 2022 at 4 p.m</p>
    <hr>
    <div class="d-flex flex-wrap justify-content-around">
        <div class="card" style="width: 100%;margin-bottom: 1rem;">
            <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-success">Vote</a>
            </div>
        </div>
        <div class="card" style="width: 100%;margin-bottom: 1rem;">
            <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-success">Vote</a>
            </div>
        </div>
        <div class="card" style="width: 100%;margin-bottom: 1rem;">
            <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-success">Vote</a>
            </div>
        </div>
    </div>
</div>
@endsection
