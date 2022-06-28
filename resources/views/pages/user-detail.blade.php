@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Show breadcrumb Events Page --}}
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
        </ol>
    </section>

    {{-- USER DETAIL SECTION --}}
    <section class="mb-4">
        <h1 class="fw-bold">{{ $user->name }}</h1>
        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
            <span class="h5 mb-1 text-break">{{ $user->email }}</span>
            @isset($user->email_verified_at)
                <span class="badge rounded-pill bg-primary" title="Email is verified">Verified</span>
            @else
                <span class="badge rounded-pill bg-secondary" title="Email has not been verified">Unverified</span>
            @endisset
        </div>

        <table class="table">
            <tr>
                <th class="fw-normal">Created at</th>
                <td>{{ $user->created_at->format('D, d M Y, H.i') }}</td>
            </tr>
            <tr>
                <th class="fw-normal">Updated at</th>
                <td>{{ $user->updated_at->format('D, d M Y, H.i') }}</td>
            </tr>
            @isset($user->email_verified_at)
                <tr>
                    <th class="fw-normal">Email verified at</th>
                    <td>{{ $user->email_verified_at->format('D, d M Y, H.i') }}</td>
                </tr>
            @endisset
        </table>
    </section>

    {{-- EVENTS SECTION --}}
    <section class="mb-4">
        <h2 class="mb-3">Events</h2>
        @if ($events->count() > 0)
            <div id="eventList" class="d-flex flex-column flex-wrap gap-3">
                {{-- Load each `event` in `events` --}}
                @foreach ($events as $event)
                    <a class="event-item card shadow-sm" href="{{ route('events.show', ['event' => $event]) }}">
                        <div class="card-body">
                            <p class="h5 card-title">{{ $event->title }}</p>
                            @isset($event->started_at)
                                <div class="d-flex flex-wrap mb-2">
                                    <div class="d-flex gap-2 align-items-center me-4" title="Started at">
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
                <p class="text-muted mb-0">There are not any events</p>
            </div>
        @endif
    </section>

    {{-- DELETE USER --}}
    <section class="mb-4">
        <h2 class="h3 text-danger mb-3">Delete User</h2>
        <div class="p-3 border border-danger shadow shadow-sm">
            <p><span class="text-danger fw-bold">Warning!</span> You <strong>can't undo</strong> this action.<br>All user data, events, options, voters and ballots <strong>will be lost</strong>.</p>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete User</button>
        </div>
    </section>
</div>

<!-- Modal -->
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

@endsection
