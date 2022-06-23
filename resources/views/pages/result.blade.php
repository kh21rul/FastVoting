@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section class="mb-4">
        @if ($event->finished_at->isFuture())
            <h1 class="fs-5 text-muted mb-0">Real-Count of</h1>
        @else
            <h1 class="fs-5 text-muted mb-0">Voting Result of</h1>
        @endif
        <h2 class="h1 mb-3 fw-bold">{{ $event->title }}</h2>
        <div class="d-flex flex-wrap gap-2 mb-3">
            <div class="d-flex gap-2 align-items-center me-3" title="Started at">
                <i class="fa-solid fa-calendar-day fa-lg"></i>
                <span>{{ $event->started_at->format('D, d M Y, H.i e') }}</span>
            </div>
            <div class="d-flex gap-2 align-items-center" title="Finished at">
                <i class="fa-solid fa-calendar-week fa-lg"></i>
                <span>{{ $event->finished_at->format('D, d M Y, H.i e') }}</span>
            </div>
        </div>

        @isset($event->description)
            {!! $event->description !!}
        @endisset
    </section>

    <hr>

    <section class="mb-4">
        <table class="table">
            <tbody>
              <tr>
                <th>Total Registered Voters</th>
                <td>{{ $event->voters->count() }}</td>
              </tr>
              <tr>
                <th>Total Incoming Votes</th>
                <td>{{ $event->ballots->count() }}</td>
              </tr>
              <tr>
                <th>Incoming Votes Percentage</th>
                <td>{{ $event->ballots->count() / $event->voters->count() * 100 }}%</td>
              </tr>
            </tbody>
        </table>
        <div class="option-list">
            @foreach ($event->options as $option)
                <div class="card option-item">
                    <div class="row g-0">
                        {{-- Option Image --}}
                        @isset($option->image_location)
                            <div class="col-4 option-item__image-frame">
                                <img class="option-item__image" src="{{ route('options.image', ['option' => $option, 'voterId' => $voter->id, 'token' => $voter->token]) }}" alt="{{ $option->name }}">
                            </div>
                        @endisset
                        <div class="@isset($option->image_location) col-8 @endisset">
                            <div class="card-body">
                                <p class="card-title fs-5">{{ $option->name }}</p>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span>Total Votes</span>
                                    <span>{{ $option->ballots->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span>Votes Percentage</span>
                                    <span>{{ $option->ballots->count() / $event->voters->count() * 100 }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

@endsection
