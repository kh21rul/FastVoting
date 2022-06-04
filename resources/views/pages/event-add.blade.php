@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Event</h2>
    <hr>
    <form method="POST" action="#">
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Tittle <span style="color:red;font-weight:bold">*</span></label>
            <input type="text" id="form1Example1" class="form-control" placeholder="Enter tittle event" required/>
        </div>
        <div class="row mb-4">
            <label class="form-label">Starting date & time <span style="color:red;font-weight:bold">*</span></label>
            <div class="col">
              <div class="form-outline">
                <input type="date" id="form2Example1" class="form-control" />
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <input type="time" id="form3Example2" class="form-control" />
              </div>
            </div>
        </div>
        <div class="row mb-4">
            <label class="form-label">Closed date & time <span style="color:red;font-weight:bold">*</span></label>
            <div class="col">
              <div class="form-outline">
                <input type="date" id="form4Example1" class="form-control" />
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <input type="time" id="form5Example2" class="form-control" />
              </div>
            </div>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form6Example1">Description Event <span style="color:red;font-weight:bold">*</span></label>
            <input type="text" id="form1Example1" class="form-control" placeholder="Enter description event" required/>
        </div>
        <div class="row mb-4">
            <label class="form-label">Choice <span style="color:red;font-weight:bold">*</span></label>
            <div class="col">
              <div class="form-outline">
                <a type="submit" class="btn btn-primary" href="{{route('options')}}" style="margin-right: 2%">Add Option</a>
              </div>
            </div>
        </div>
    </form>
    <form>
        <div class="d-flex flex-wrap justify-content-around">
            <div class="card" style="width: 100%;margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                <div class="card-body">
                  <h5 class="card-title">Name : <span>Lorem Ipsum</span></h5>
                  <h5 class="card-text">Description :</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sem ligula, dapibus nec odio facilisis, facilisis bibendum leo. Quisque laoreet vitae purus nec auctor.</p>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="width:100%;">SUBMIT</button>
    </form>
</div>
@endsection
