@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('events.show', ['event' => $event]) }}">Event</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </section>
    <h1>{{ __('Edit Event') }}</h1>
    <form action="{{ route('events.update', ['event' => $event]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" value="{{ old('title') ?? $event->title }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{ old('description', $event->description) }}">
            <trix-editor input="description"></trix-editor>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
         <div class="form-outline mb-3">
            <label for="timezone" class="form-label">Timezone</label>
            <input type="text" list="timezoneList" class="form-control @error('timezone') is-invalid @enderror" id="timezone" name="timezone" placeholder="Set the event timezone" value="{{ old('timezone', $event->timezone) }}">
            <datalist id="timezoneList">
                @foreach (DateTimeZone::listIdentifiers() as $timezone)
                    <option value="{{ $timezone }}">{{ $timezone }} ({{ now($timezone)->getOffsetString() }})</option>
                @endforeach
            </datalist>
            @error('timezone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="form-text">Set the timezone for this event. For example: <b>Asia/Jakarta</b> or <b>UTC</b>.</span>
        </div>
        <div class="form-group mb-3">
            <label for="startedAt" class="form-label">Started At</label>
            <input type="datetime-local" class="form-control @error('started_at') is-invalid @enderror" id="startedAt" name="started_at" placeholder="Started At" value="{{ old('started_at') ?? $event->started_at }}">
            @error('started_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="form-text">The start time should be more than now.</span>
        </div>
        <div class="form-group mb-3">
            <label for="finishedAt" class="form-label">Finished At</label>
            <input type="datetime-local" class="form-control @error('finished_at') is-invalid @enderror" id="finishedAt" name="finished_at" placeholder="Finished At" value="{{ old('finished_at') ?? $event->finished_at }}">
            @error('finished_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="form-text">The finish time should be more than the start time.</span>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Edit Event') }}</button>
    </form>
</div>
@endsection
