@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Displaying alert error --}}
    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-3 d-flex justify-content-end">
        <a class="btn btn-primary" href="{{ route('event.add') }}">Add Event</a>
    </div>
    <div class="d-flex flex-wrap justify-content-around">
        {{-- Load each `event` in `events` --}}
        @foreach ($events as $event)
            <a href="{{ route('event.detail', ['id' => $event->id])}}" class="card my-2 w-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <b>{{ __('Started at: ') }}</b>
                    <span>{{ $event->started_at }}</span>
                    <br>
                    <b>{{ __('Finished at: ') }}</b>
                    <span>{{ $event->finished_at }}</span>

                    {{-- Load event's `description` if not empty --}}
                    @if ($event->description)
                        <p class="card-text">{{ $event->description }}</p>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
