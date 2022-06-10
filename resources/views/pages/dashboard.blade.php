@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3 d-flex justify-content-between">
        <h2>Welcome <span>{{ Auth::user()->name }}</span></h2>
        <a type="button" class="btn btn-primary" href="{{ route('event.add') }}">Add Event</a>
    </div>
    
    <div id="container" class="d-flex flex-wrap justify-content-around">
        {{-- Load each `event` in `events` --}}
        @foreach ($events as $event)
            <div class="event-item d-flex flex-wrap justify-content-around" >
                <div class="card my-2" style="width: 100%; box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25)">
                    <a href="{{ route('event.detail', ['id' => $event->id]) }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <span class="card-text"><span><img class="img-fluid" src="{{asset('assets/Calendar.png')}}" alt=""></span>{{ $event->started_at }} - {{ $event->finished_at }}</span>
                            @if ($event->description)
                              <p class="card-text mt-2" id="desc">{{ $event->description }}</p>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    const container = document.getElementById("container");
    const eventItems = container.querySelector('.event-item');
    
    eventItems.foreach((item) => {
      const description = item.getElementById('desc');
      description.innerHTML = description.innerHTML.slice(0,248) + '...';
    });
</script>
@endsection
