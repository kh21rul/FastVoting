@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Event</h2>
    <hr>
    <form action="{{ route('event.detail') }}">
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
        <div class="row mb-5">
              <div class="d-grid gap-2 col-1">
                <button type="submit" class="btn btn-primary" style="margin-right: 2%">Submit</button>
              </div>
            </div>
        </div>
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
            const endTime = document.getElementById("close-t  ime").value;

            if(startTime>endTime){
                    alert('start time should be smaller');
                    document.getElementById("close-time").value = "";
                }
        });
</script>
@endsection
