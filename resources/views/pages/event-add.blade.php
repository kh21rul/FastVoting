@extends('layouts.app')
@include('components.trix-editor')

@section('content')
<div class="container py-4">
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Event</li>
        </ol>
    </section>
    <h2>Add Event</h2>
    <hr>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="form-outline mb-4">
            <label class="form-label" for="title">
              <span>Title</span>
              <span style="color:red;font-weight:bold">*</span>
            </label>
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter title event" value="{{ old('title') }}" required/>
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
            <input id="description" type="hidden" name="description" value="{{ old('description') }}">
            <trix-editor input="description"></trix-editor>
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
@endsection
