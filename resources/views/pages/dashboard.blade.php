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
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete User</button>
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

<!-- Modal -->
@if (Auth::user()->is_admin)
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">{{ __('Delete This User?') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('You are going to delete this user. Are you sure with this?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <form action="{{ route('users.destroy', ['user' => $user]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">{{ __('Yes, Delete Now') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
