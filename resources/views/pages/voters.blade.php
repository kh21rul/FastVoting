@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>Voters</h1>
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
