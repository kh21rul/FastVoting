@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Show breadcrumb Events Page --}}
    @if (Auth::user()->is_admin)
        <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Events</li>
            </ol>
        </section>
    @endif

    <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap">
        @if (Auth::user()->is_admin)
            <h2>{{ $user->name }}{{ __('\'s Events') }}</h2>
        @else
            <h2>Welcome, <span>{{ Auth::user()->name }}</span>!</h2>
            <a type="button" class="btn btn-primary" href="{{ route('events.create') }}">Add Event</a>
        @endif
    </div>

    @if ($events->count() > 0)
        <div id="eventList" class="d-flex flex-column flex-wrap gap-3">
            {{-- Load each `event` in `events` --}}
            @foreach ($events as $event)
                <a class="event-item card shadow-sm" href="{{ route('events.show', ['event' => $event]) }}">
                    <div class="card-body">
                        <p class="h5 card-title">{{ $event->title }}</p>
                        @isset($event->started_at)
                            <div class="d-flex flex-wrap mb-2">
                                <div class="d-flex gap-2 align-items-center me-3" title="Started at" style="width: 320px;">
                                    <i class="fa-solid fa-calendar-day"></i>
                                    <span>{{ $event->started_at->format('D, d M Y, H.i e') }}</span>
                                </div>
                                @isset($event->finished_at)
                                    <div class="d-flex gap-2 align-items-center" title="Finished at">
                                        <i class="fa-solid fa-calendar-week"></i>
                                        <span>{{ $event->finished_at->format('D, d M Y, H.i e') }}</span>
                                    </div>
                                @endisset
                            </div>
                        @endisset
                        @if ($event->description)
                            <p class="event-item__description card-text">{{ strip_tags(str_replace(['<div>', '<br>', '<li>'], ' ', $event->description)) }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center border p-4 bg-light">
            <p class="text-muted mb-0">
                @if (Auth::user()->is_admin)
                    There are not any events
                @else
                    You haven't created any events yet
                @endif
            </p>
        </div>
    @endif
</div>
@endsection
