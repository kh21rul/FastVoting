@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section class="mb-4">
        <h1 class="mb-3 fw-bold">{{ $voter->event->title }}</h1>
        <div class="d-flex flex-wrap gap-2 mb-3">
            <div class="d-flex gap-2 align-items-center me-3" title="Started at">
                <i class="fa-solid fa-calendar-day fa-lg"></i>
                <span>{{ $voter->event->started_at->format('D, d M Y, H.i e') }}</span>
            </div>
            <div class="d-flex gap-2 align-items-center" title="Finished at">
                <i class="fa-solid fa-calendar-week fa-lg"></i>
                <span>{{ $voter->event->finished_at->format('D, d M Y, H.i e') }}</span>
            </div>
        </div>

        @if ($voter->event->started_at->isFuture())
            <div class="p-3 bg-white border border-danger text-center">
                <span class="text-danger">This vote is not opened yet.</span>
            </div>
        @endif

        @isset($voter->event->description)
            {!! $voter->event->description !!}
        @endisset
    </section>

    <hr>

    {{-- Ballot --}}
    <section class="mb-4">
        <h2>Vote Now</h2>
        <table class="table table-borderless mb-3">
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
                <div class="option-item card">
                    {{-- Option Image --}}
                    <div class="option-item__image-frame">
                        @if ($option->image_location)
                            <img src="{{ route('options.image', ['option' => $option, 'voterId' => $voter->id, 'token' => $voter->token]) }}" class="option-item__image" alt="{{ $option->name }}">
                        @else
                            {{-- Default image --}}
                            <img src="{{ asset('assets/image-option.jpg') }}" class="option-item__image" alt="No image">
                        @endif
                    </div>
                    {{-- Option Name --}}
                    <div class="@isset($option->image_location) @endisset">
                        <div class="card-body">
                            <p class="card-title fs-5 fw-bold">{{ $option->name }}</p>
                            @isset($option->description)
                                <p class="card-text">{!! $option->description !!}</p>
                            @endisset
                            <div class="d-flex justify-content-start gap-2 mt-3">
                                @if ($voter->event->started_at->isPast())
                                    <form action="{{ route('vote.save', ['voterId' => $voter->id, 'token' => $voter->token]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="option_id" value="{{ $option->id }}">
                                        <button type="submit" class="btn btn-success">Vote</button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-success" disabled>Vote</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
