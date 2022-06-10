@extends('layouts.app')

@section('content')
<div class="container">
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Event</li>
        </ol>
    </section>
    <h2>Add Event</h2>
    <hr>
    <form action="{{ route('event.create') }}" method="POST">
        @csrf
        <div class="form-outline mb-4">
            <label class="form-label" for="title">
              <span>Title</span> 
              <span style="color:red;font-weight:bold">*</span>
            </label>
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter title event" value="{{ old('title') }} required/>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label for="description" class="form-label">
                <span>Description</span>
            </label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter the description event">{{ old('description') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-outline mb-2">
            <label for="startedAt" class="form-label">
              <span>Started At</span>
              <span style="color:red;font-weight:bold">*</span>
            </label>
            <input type="datetime-local" class="form-control @error('started_at') is-invalid @enderror" id="startedAt" name="started_at" placeholder="Started At" min="{{ Date::now()->format('Y-m-d H:i') }}" value="{{ old('started_at') }}">
            @error('started_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="form-text">This date using UTC timezone.</span>
        </div>
        <div class="form-outline mb-3">
            <label for="finishedAt" class="form-label">Finished At</label>
            <input type="datetime-local" class="form-control @error('finished_at') is-invalid @enderror" id="finishedAt" name="finished_at" placeholder="Finished At" value="{{ old('finished_at') }}">
            @error('finished_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="form-text">This date using UTC timezone.</span>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Add Event') }}</button>
    </form>
</div>
{{--
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
--}}
@endsection
