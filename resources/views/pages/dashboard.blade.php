@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome <span>{{ Auth::user()->name }}</span></h2>
    <div class="d-flex justify-content-start">
        <a type="button" class="btn btn-primary" href="{{route('event.add')}}" style="margin-right: 2%">Add Vote</a>
    </div>

    <div id="container"> </div>
</div>
    <script>
        const container = document.getElementById("container");
        const teksdescription = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque doloribus dolores molestiae dolorum. Vitae nostrum iste nisi, culpa, animi deleniti ex ducimus aperiam necessitatibus, sit sunt molestias magni porro aliquam.Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque doloribus dolores molestiae dolorum. Vitae nostrum iste nisi, culpa, animi deleniti ex ducimus aperiam necessitatibus, sit sunt molestias magni porro aliquam.';

        const template = (a) => {
        for (let i = 0; i < a; i++) {
                container.innerHTML += `
                <div class="d-flex flex-wrap justify-content-around" >
                    <div class="card my-2" style="width: 100%; box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25)">
                        <a href="{{ route('event.detail') }}">
                            <div class="card-body">
                                <h5 class="card-title">Lorem Ipsum</h5>
                                <p class="card-text"><span><img class="img-fluid" src="{{asset('assets/Calendar.png')}}" alt=""></span> 25 June 2022</p>
                                <p class="card-text" id="desc">${teksdescription.slice(0,248) + '.......'}</p>
                            </div>
                        </a>
                    </div>
                </div>
                `;
            }
        }

        template(25);
    </script>
@endsection
