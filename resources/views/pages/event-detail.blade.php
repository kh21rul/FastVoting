@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Event</li>
        </ol>
    </section>
    <section class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
        <h1>{{ $event->title }}</h1>
        <div class="d-flex gap-2">
            @if (!$event->is_committed)
                <a class="btn btn-secondary" href="{{ route('event.edit', ['id' => $event->id]) }}">{{ __('Edit Event') }}</a>
            @endif
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">{{ __('Delete Event') }}</button>
        </div>
    </section>
    <hr>
    <section class="table-responsive mb-3">
        <table class="table" style="min-width: 204px">
            <tbody>
                <tr>
                    <th>{{ __('Started At') }}</th>
                    <td>
                        @if ($event->started_at)
                            {{ $event->started_at->format('D, j M Y H:i:s e') }}
                        @else
                            <span class="text-muted">{{ __('Not set') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Finished At') }}</th>
                    <td>
                        @if ($event->finished_at)
                            {{ $event->finished_at->format('D, j M Y H:i:s e') }}
                        @else
                            <span class="text-muted">{{ __('Not set') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Description') }}</th>
                    <td>
                        @if ($event->description)
                            {{ $event->description }}
                        @else
                            <span class="text-muted">{{ __('Not set') }}</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    {{-- Options --}}
    <h2>{{ __('Options') }}</h2>
    <section class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
        <span>{{ $event->options->count() }} {{ $event->options->count() > 1 ? __('options available') : __('option available') }}</span>
        @if (!$event->is_committed)
            <a class="btn btn-primary" href="{{ route('option.add', ['id' => $event->id]) }}">{{ __('Add Option') }}</a>
        @endif
    </section>
    <section class="mb-3">
        @if ($event->options->count() > 0)
        <div class="d-flex gap-2 flex-wrap">
            @foreach ($event->options as $option)
                <div class="card" style="width: 18rem;">
                    @if ($option->image_location)
                        <img src="{{ route('option.image', ['name' => $option->image_location]) }}" class="card-img-top" alt="Option Image" style="height:200px; overflow:hidden">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $option->name }}</h5>
                        @if ($option->description)
                            <p class="card-text">{{ $option->description }}</p>
                        @endif

                        @if (!$event->is_committed)
                            <form action="{{ route('option.delete', ['id' => $event->id, 'optionId' => $option->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
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

    {{-- Commit --}}
    <h2>{{ __('Commit Event') }}</h2>
    @if (!$event->is_committed)
        <div class="p-3 bg-white border mb-3">
            <p>Commit this event to start the voting at the time you specify. We will send a voting link to each voter's email.</p>
            <p>Before commit, make sure you fulfill this requirement:</p>
            <ul>
                @foreach ($event->getCommitChecklist() as $checkItem)
                    <li>
                        <span class="me-1">{{ $checkItem['name'] }}</span>
                        @if ($checkItem['is_fulfilled'])
                            <i class="fa-solid fa-check" title="Fulfilled"></i>
                        @else
                            <i class="fa-solid fa-xmark" title="Not fulfilled"></i>
                        @endif
                    </li>
                @endforeach
            </ul>

            <p><strong class="text-danger">Warning!</strong> You <strong>can't change</strong> the event's detail, the options, and the voters after you commit this event.</p>
            @if ($event->isAllCommitChecklistFulfilled())
                <form action="{{ route('event.commit', ['id' => $event->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">{{ __('Commit Event') }}</button>
                </form>
            @else
                <button type="button" class="btn btn-outline-danger" disabled>{{ __('Commit Event') }}</button>
            @endif
        </div>
    @else
        <div class="p-3 bg-white border mb-3 text-center border border-success">
            <span class="text-success">This event has been committed.</span>
        </div>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">{{ __('Delete This Event?') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{ __('This event will be deleted with all voters and ballots?') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        <form action="{{ route('event.delete', ['id' => $event->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
