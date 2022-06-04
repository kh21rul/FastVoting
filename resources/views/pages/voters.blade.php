@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('event.detail', ['id' => $event->id]) }}">Event</a></li>
            <li class="breadcrumb-item active" aria-current="page">Voters</li>
        </ol>
    </section>
    {{-- Displaying alert error --}}
    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>Voters</h1>
    <section class="my-3">
        <form class="card" action="{{ route('voters', ['id' => $event->id]) }}" method="post">
            @csrf
            <div class="card-body">
                <h2>Add Voter</h2>
                <div class="form-group mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
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
                            <form action="{{ route('voter.delete', ['id' => $event->id, 'voterId' => $voter->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger" type="submit" title="Remove Voter">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </button>
                            </form>
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
