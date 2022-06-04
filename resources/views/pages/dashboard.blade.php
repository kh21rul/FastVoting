@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome <span>{{ Auth::user()->name }}</span></h2>
    <div class="d-flex justify-content-start">
        <a type="button" class="btn btn-primary" href="{{route('event.add')}}" style="margin-right: 2%">Add Vote</a>
    </div>
    <div class="d-flex flex-wrap justify-content-around">
        <div class="card my-2" style="width: 100%; box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
            <a href="{{ route('event.detail') }}">
                <div class="card-body">
                    <h5 class="card-title">Lorem Ipsum</h5>
                    <p class="card-text"><span><img class="img-fluid" src="{{asset('assets/Calendar.png')}}" alt=""></span> 25 June 2022</p>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sem ligula, dapibus nec odio facilisis, facilisis bibendum leo. Quisque laoreet vitae purus nec auctor.</p>
                  </div>
            </a>
        </div>
        <div class="card my-2" style="width: 100%; box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
            <a href="{{ route('event.detail') }}">
                <div class="card-body">
                    <h5 class="card-title">Lorem Ipsum</h5>
                    <p class="card-text"><span><img class="img-fluid" src="{{asset('assets/Calendar.png')}}" alt=""></span> 25 June 2022</p>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sem ligula, dapibus nec odio facilisis, facilisis bibendum leo. Quisque laoreet vitae purus nec auctor.</p>
                  </div>
            </a>
        </div>
        <div class="card my-2" style="width: 100%; box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
            <a href="{{ route('event.detail') }}">
                <div class="card-body">
                    <h5 class="card-title">Lorem Ipsum</h5>
                    <p class="card-text"><span><img class="img-fluid" src="{{asset('assets/Calendar.png')}}" alt=""></span> 25 June 2022</p>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sem ligula, dapibus nec odio facilisis, facilisis bibendum leo. Quisque laoreet vitae purus nec auctor.</p>
                  </div>
            </a>
        </div>
    </div>
</div>
@endsection
