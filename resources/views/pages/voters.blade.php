@extends('layouts.app')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('event.detail') }}">Detail Event</a></li>
          <li class="breadcrumb-item active" aria-current="page">Voters</li>
        </ol>
    </nav>
    <h2>Voters</h2>
    <hr>
    <form action="{{ route('event.detail') }}">
        <p class="description-text">Add the participants you want to be able to choose the event you create</p>
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Name <span style="color:red;font-weight:bold">*</span></label>
            <input type="text" id="form1Example1" class="form-control" placeholder="Enter name participant" required/>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Email <span style="color:red;font-weight:bold">*</span></label>
            <input type="email" id="form2Example1" class="form-control" placeholder="Enter email participant" required/>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Add Participant</button>
    </form>
    <h2 class="my-2 py-2">Participant</h2>
    <div class="d-flex flex-wrap justify-content-around">
        <div class="card shadow-sm p-3 mb-3 bg-white rounded" style="width: 100%;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="card-text">Name : <span>Fast Voting User</span></p>
                        <p class="card-text">Email : <span>fastVoting@xxx.com</span></p>
                    </div>
                    <div class="align-self-center">
                        <button class="btn btn-outline-danger" type="submit" title="Remove Voter">
                            <i class="fa-solid fa-user-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm p-3 mb-3 bg-white rounded" style="width: 100%;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="card-text">Name : <span>Fast Voting User</span></p>
                        <p class="card-text">Email : <span>fastVoting@xxx.com</span></p>
                    </div>
                    <div class="align-self-center">
                        <button class="btn btn-outline-danger" type="submit" title="Remove Voter">
                            <i class="fa-solid fa-user-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
