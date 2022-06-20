@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>{{ $voter->event->title }}</h1>
    <div class="d-flex flex-wrap mb-3">
        <div class="d-flex gap-2 align-items-center me-3" title="Started at" style="width: 320px;">
            <i class="fa-solid fa-calendar-day"></i>
            <span>{{ $voter->event->started_at->format('D, d M Y, H.i e') }}</span>
        </div>
        <div class="d-flex gap-2 align-items-center" title="Finished at">
            <i class="fa-solid fa-calendar-week"></i>
            <span>{{ $voter->event->finished_at->format('D, d M Y, H.i e') }}</span>
        </div>
    </div>
    @isset($voter->event->description)
        <p class="fs-6">{{ $voter->event->description }}</p>
    @endisset

    <hr class="mb-4">

    @if ($voter->event->started_at->isFuture())
        <div class="p-3 bg-white border border-danger mb-4 text-center">
            <span class="text-danger">This vote is not opened yet.</span>
        </div>
    @endif

    <h2>Your Identity</h2>
    <table class="table table-borderless mb-4">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $voter->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $voter->email }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Option List --}}
    <div class="option-list">
        @foreach ($voter->event->options as $option)
            <div class="card option-item">
                <div class="row g-0">
                    <div class="@isset($option->image_location) col-8 @endisset">
                        <div class="card-body">
                            <p class="card-title fs-5 fw-bold">{{ $option->name }}</p>
                            @isset($option->description)
                                <p class="card-text">{{ $option->description }}</p>
                            @endisset
                            @if ($voter->event->started_at->isPast())
                                <form action="{{ route('vote.save', ['voterId' => $voter->id, 'token' => $voter->token]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="option_id" value="{{ $option->id }}">
                                    <button type="submit" class="btn btn-success">Vote</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    {{-- Option Image --}}
                    @isset($option->image_location)
                        <div class="col-4 option-item__image-frame">
                            <img class="option-item__image" src="{{ route('options.image', ['option' => $option, 'voterId' => $voter->id, 'token' => $voter->token]) }}" alt="{{ $option->name }}">
                        </div>
                    @endisset
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
