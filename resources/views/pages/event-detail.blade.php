@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
        <h1>{{ $event->title }}</h1>
        <div class="d-flex gap-2">
            <a class="btn btn-secondary" href="#">{{ __('Edit Event') }}</a>
            <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Delete Event') }}</button>
        </div>
    </section>
    <hr>
    <section class="mb-3">
        <p><b>{{ __('Started at: ') }}</b> {{ $event->started_at ?? __('-') }}</p>
        <p><b>{{ __('Finished at: ') }}</b> {{ $event->finished_at ?? __('-') }}</p>
        <b>{{ __('Description: ') }}</b>
        @if ($event->description)
            <p>{{ $event->description }}</p>
        @else
            <p class="text-muted">{{ __('There are no description') }}</p>
        @endif
    </section>

    {{-- Options --}}
    <h2>{{ __('Options') }}</h2>
    <section class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
        <span>{{ $event->options->count() }} {{ $event->options->count() > 1 ? __('options available') : __('option available') }}</span>
        <a class="btn btn-primary" href="/events/options/create">{{ __('Add Option') }}</a>
    </section>
    <section class="mb-3">
        @if ($event->options->count() > 0)
            @foreach ($event->options as $option)
                <article class="card mb-2">
                    {{-- <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt=""></div> --}}
                    <div class="card-body">
                        <span class="card-title">{{ $option->name }}</span>
                        @if ($option->description)
                            <p class="card-text">{{ $option->description }}</p>
                        @endif
                    </div>
                </article>
            @endforeach
        @else
            <div class="card p-3 text-center">
                <span class="text-muted">{{ __('There are no options') }}</span>
            </div>
        @endif
    </section>

    {{-- Voters --}}
    <h2>{{ __('Voters') }}</h2>
    <section class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
        <span>{{ $event->voters->count() }} {{ $event->voters->count() > 1 ? __('registered voters') : __('registered voter')  }}</span>
        <a class="btn btn-primary" href="{{ route('voters', ['id' => $event->id]) }}">{{ __('Show All') }}</a>
    </section>
    <section class="mb-3">
        @if ($event->voters->count() > 0)
            {{-- Showing max. 5 voters --}}
            @foreach ($event->voters->sortBy('email', SORT_NATURAL)->take(5) as $voter)
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
