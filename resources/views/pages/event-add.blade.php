@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Event</h2>
    <hr>
    <form action="{{ route('options') }}">
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Tittle <span style="color:red;font-weight:bold">*</span></label>
            <input type="text" id="form1Example1" class="form-control" placeholder="Enter tittle event" required/>
        </div>
        <div class="row mb-4">
            <label class="form-label">Starting date & time <span style="color:red;font-weight:bold">*</span></label>
            <div class="col">
              <div class="form-outline">
                <input type="date" id="start-date" class="form-control" required />
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <input type="time" id="start-time" class="form-control" required/>
              </div>
            </div>
        </div>
        <div class="row mb-4">
            <label class="form-label">Closed date & time <span style="color:red;font-weight:bold">*</span></label>
            <div class="col">
              <div class="form-outline">
                <input type="date" id="close-date" class="form-control" required/>
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <input type="time" id="close-time" class="form-control" required/>
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
                <button type="submit" class="btn btn-primary" style="margin-right: 2%">Add Option</button>
              </div>
            </div>
        </div>
    </form>
    <form>
        <div class="d-flex flex-wrap choiceCard">
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2" style="height: 75%"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="max-width: 100%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2" style="height: 75%"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="max-width: 100%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2" style="height: 75%"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="max-width: 100%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="width:100%;">SUBMIT</button>
    </form>
</div>
<script>
        $("#close-date").change(function () {
            const startDate = document.getElementById("start-date").value;
            const endDate = document.getElementById("close-date").value;

            if ((Date.parse(startDate) > Date.parse(endDate))) {
                alert("Close date should be greater than Start date");
                document.getElementById("close-date").value = "";
            }
        });

        $("#close-time").change(function () {
            const startTime = document.getElementById("start-time").value;
            const endTime = document.getElementById("close-time").value;

            if(startTime>endTime){
                    alert('start time should be smaller');
                    document.getElementById("close-time").value = "";
                }
        });


</script>
@endsection
