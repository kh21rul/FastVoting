@extends('layouts.app')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail Event</li>
        </ol>
    </nav>
    <h2 class="detail-event">Lorem Ipsum</h2>
    <div class="d-flex justify-content-end my-2">
        <a type="button" class="btn btn-success" style="margin-right:1%;" href="{{'add'}}">Edit Event</a>
        <a type="button" class="btn btn-danger" href="#">Delete Event</a>
    </div>
    <table class="table" style="font-size: 1.1em">
        <tbody>
          <tr>
            <td colspan="1">Starting</td>
            <td>:</td>
            <td>25 June 2022 at 8 AM</td>
          </tr>
          <tr>
            <td colspan="1">Closed</td>
            <td>:</td>
            <td>25 June 2022 at 5 PM</td>
          </tr>
          <tr>
            <td colspan="1">Description</td>
            <td>:</td>
            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut fuga, magnam facilis, consequuntur itaque non voluptates id quasi perferendis expedita quaerat corporis, ad ipsum dolorum.</td>
          </tr>
          <tr>
            <td colspan="1">Total Participants</td>
            <td>:</td>
            <td>1000</td>
          </tr>
          <tr>
            <td colspan="1">Total Vote</td>
            <td>:</td>
            <td>800</td>
          </tr>
        </tbody>
    </table>
    <div class="choice-detailEvent">
        <div class="choice-detailEvent">
            <h3 class="mt-2">Options to Vote :</h3>
            <a class="btn btn-primary btn-block my-2" href="{{ route('options') }}">Add Option</a>
            <div class="d-flex flex-wrap choiceCard">
                <div class="card choice" style="margin-bottom: 1rem;">
                    <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                    <div class="card-body">
                      <h5 class="card-title text-center">Special title treatment</h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <div class="d-flex justify-content-start">
                        <a type="button" class="btn btn-success" href="#" style="margin-right: 1%">Edit Option</a>
                        <a type="button" class="btn btn-danger" href="#">Delete</a>
                      </div>
                    </div>
                </div>
                <div class="card choice" style="margin-bottom: 1rem;">
                    <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                    <div class="card-body">
                      <h5 class="card-title text-center">Special title treatment</h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <div class="d-flex justify-content-start">
                        <a type="button" class="btn btn-success" href="#" style="margin-right: 1%">Edit Option</a>
                        <a type="button" class="btn btn-danger" href="#">Delete</a>
                      </div>
                    </div>
                </div>
                <div class="card choice" style="margin-bottom: 1rem;">
                    <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                    <div class="card-body">
                      <h5 class="card-title text-center">Special title treatment</h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <div class="d-flex justify-content-start">
                        <a type="button" class="btn btn-success" href="#" style="margin-right: 1%">Edit Option</a>
                        <a type="button" class="btn btn-danger" href="#">Delete</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
