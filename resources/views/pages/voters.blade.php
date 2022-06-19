@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('events.show', ['event' => $event]) }}">Event</a></li>
            <li class="breadcrumb-item active" aria-current="page">Voters</li>
        </ol>
    </section>

    <h1>Voters</h1>
    <p class="description-text">Add the participants you want to be able to choose the event you create</p>
    @if (!$event->is_committed)
        <section class="my-3">
            <form class="card" action="{{ route('voters', ['id' => $event->id]) }}" method="post">
                @csrf
                <div class="card-body">
                    <h2>Add Voter</h2>
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">
                            <span>Email</span>
                            <span style="color:red;font-weight:bold">*</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter the voter's email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="name">
                            <span>Name</span>
                            <span style="color:red;font-weight:bold">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter the voter's name" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Voter</button>
                </div>
            </form>
        </section>
    @endif

    {{-- Show the voters list --}}
    <section class="mb-3">
        @if ($event->voters->count() > 0)
            @foreach ($event->voters->sortBy('email', SORT_NATURAL) as $voter)
                <article class="card mb-2">
                    <div class="card-body d-flex align-items-center justify-content-between gap-2 overflow-auto">
                        <div class="">
                            <p class="card-title mb-0 fs-5">{{ $voter->name }}</p>
                            <p class="mb-0">{{ $voter->email }}</p>
                        </div>
                        <div class="">
                            @if ($event->is_committed)
                                {{-- TODO: Resend vote link email --}}
                            @else
                                <form action="{{ route('voter.delete', ['id' => $event->id, 'voterId' => $voter->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit" title="Remove Voter">
                                        <i class="fa-solid fa-user-xmark"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        @else
            <div class="card p-3 text-center">
                <span class="text-muted">{{ __('There are no voters') }}</span>
            </div>
        @endif
    </section>
</div>
@endsection
