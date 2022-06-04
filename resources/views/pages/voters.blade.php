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
                    <div class="card-body">
                        <p class="card-title mb-0 fs-5">{{ $voter->name }}</p>
                        <p class="mb-0">{{ $voter->email }}</p>
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
