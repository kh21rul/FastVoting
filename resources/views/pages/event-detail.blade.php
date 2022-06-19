@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Event</li>
        </ol>
    </section>

    <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
        <h1 class="m-0">{{ $event->title }}</h1>
        @if (!$event->is_committed)
            <a type="button" class="btn btn-outline-secondary" href="{{ route('events.edit', ['event' => $event]) }}" title="Edit this event">
                <i class="fa-solid fa-pen">Edit</i>
            </a>
        @endif
    </div>

    <section class="table-responsive mb-4">
        <table class="table m-0" style="font-size: 1.1em">
            <tbody>
              <tr>
                <td colspan="1">Started at</td>
                <td>
                    @if ($event->started_at)
                        {{ $event->started_at->format('D, j M Y H:i:s e') }}
                    @else
                        <span class="text-muted">{{ __('Not set') }}</span>
                    @endif
                </td>
              </tr>
              <tr>
                <td colspan="1">Finished at</td>
                <td>
                    @if ($event->finished_at)
                        {{ $event->finished_at->format('D, j M Y H:i:s e') }}
                    @else
                        <span class="text-muted">{{ __('Not set') }}</span>
                    @endif
                </td>
              </tr>
              <tr>
                <td colspan="1">Description</td>
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
    <section class="mb-4">
        <h2>{{ __('Options') }}</h2>
        <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-3">
            <span>{{ $event->options->count() }} {{ $event->options->count() > 1 ? __('options available') : __('option available') }}</span>
            @if (!$event->is_committed)
                <a class="btn btn-primary" href="{{ route('events.options.create', ['event' => $event]) }}">{{ __('Add Option') }}</a>
            @endif
        </div>

        @if ($event->options->count() > 0)
            <div class="option-list">
                @foreach ($event->options as $option)
                    <div class="option-item card">
                        <div class="row g-0">
                            <div class="@isset($option->image_location) col-8 @endisset">
                                <div class="card-body">
                                    <p class="card-title fs-5 fw-bold">{{ $option->name }}</p>
                                    @isset($option->description)
                                        <p class="card-text">{{ $option->description }}</p>
                                    @endisset
                                    <div class="d-flex justify-content-start gap-2 mt-3">
                                        @if (!$event->is_committed)
                                            {{-- Edit Option Button --}}
                                            <a class="btn btn-outline-secondary" href="{{ route('options.edit', ['option' => $option]) }}" title="Edit this option">
                                                <i class="fa-pen fa-solid">Edit</i>
                                            </a>
                                            {{-- Delete Option Button --}}
                                            <form action="{{ route('options.destroy', ['option' => $option]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Are you sure to delete this \'{{ $option->name }}\' option?')" title="Delete this option">
                                                    <i class="fa-trash fa-solid">Delete</i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- Option Image --}}
                            @isset($option->image_location)
                                <div class="col-4 option-item__image-frame">
                                    <img class="option-item__image" src="{{ route('option.image', ['name' => $option->image_location]) }}" alt="{{ $option->name }}">
                                </div>
                            @endisset
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
    <section class="mb-4">
        <h2>{{ __('Voters') }}</h2>
        <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-3">
            <span>{{ $event->voters->count() }} {{ $event->voters->count() > 1 ? __('registered voters') : __('registered voter')  }}</span>
            <a class="btn btn-primary" href="{{ route('voters', ['id' => $event->id]) }}">{{ __('Show All') }}</a>
        </div>

        @if ($event->voters->count() > 0)
            {{-- Showing max. 5 voters --}}
            <div class="d-flex flex-wrap">
                @foreach ($event->voters->sortBy('email', SORT_NATURAL)->take(5) as $voter)
                    <article class="card mb-2" style="width: 100%">
                        <div class="card-body">
                            <p class="card-title mb-0 fs-5">{{ $voter->name }}</p>
                            <p class="mb-0">{{ $voter->email }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="card p-3 text-center">
                <span class="text-muted">{{ __('There are no voters') }}</span>
            </div>
        @endif
    </section>

    {{-- Commit --}}
    <section class="mb-4">
        <h2>{{ __('Commit Event') }}</h2>
        @if (!$event->is_committed)
            <div class="p-3 bg-white border mt-3">
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
    </section>

    {{-- Delete Event --}}
    <section class="mb-4">
        <h2>{{ __('Delete Event') }}</h2>
        <div class="p-3 bg-white border border-danger mt-3">
            <p><span class="text-danger fw-bold">Warning!</span> You <strong>can't undo</strong> this action.<br>All event data, options, voters and ballots <strong>will be lost</strong>.</p>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete Event</button>
        </div>
    </section>
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
          {{ __('You are going to delete this event. Are you sure with this?') }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
          <form action="{{ route('events.destroy', ['event' => $event]) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger">{{ __('Yes, Delete Now') }}</button>
          </form>
        </div>
      </div>
   </div>
</div>
@endsection
