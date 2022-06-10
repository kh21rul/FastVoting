@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vote Now</h2>
    <p class="card-text"><span><img class="img-fluid" src="{{asset('assets/Calendar.png')}}" alt=""></span> 25 June 2022 at 8 am - 25 June 2022 at 5 pm</p>
    <hr>
    <table class="table table-borderless" style="font-size: 1.1em;">
        <tbody>
          <tr>
            <td colspan="1">Title</td>
            <td>:</td>
            <td>Lorem Ipsum</td>
          </tr>
          <tr>
            <td colspan="1">Description</td>
            <td>:</td>
            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut fuga, magnam facilis, consequuntur itaque non voluptates id quasi perferendis expedita quaerat corporis, ad ipsum dolorum.</td>
          </tr>
          <tr>
            <td colspan="1">Name</td>
            <td>:</td>
            <td>loremipsum</td>
          </tr>
          <tr>
            <td colspan="1">email</td>
            <td>:</td>
            <td>loremipsum@fastvoting.com</td>
          </tr>
        </tbody>
    </table>
    <div class="d-flex flex-wrap choiceCard">
        <div class="card me-3" style="margin-bottom: 1rem; width: 18rem;">
            <div class="cropped">
                <img src="{{asset('assets/imgCandidate.png')}}" alt="">
            </div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a class="btn btn-success" style="width: 25%" href="{{'/events/eventId/result'}}">Vote</a>
            </div>
        </div>
        <div class="card me-3" style="margin-bottom: 1rem; width: 18rem;">
            <div class="cropped">
                <img src="{{asset('assets/imgCandidate.png')}}" alt="">
            </div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a class="btn btn-success" style="width: 25%" href="{{'/events/eventId/result'}}">Vote</a>
            </div>
        </div>
        <div class="card me-3" style="margin-bottom: 1rem; width: 18rem;">
            <div class="cropped">
                <img src="{{asset('assets/pexels-element-digital-1550337.jpg')}}" alt="">
            </div>
            <div class="card-body">
              <h5 class="card-title text-center">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a class="btn btn-success" style="width: 25%" href="{{'/events/eventId/result'}}">Vote</a>
            </div>
        </div>
    </div>
</div>
@endsection
