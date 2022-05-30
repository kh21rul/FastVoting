@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Voters</h2>
    <hr>
    <form>
        <p class="description-text">Add the participants you want to be able to choose the event you create</p>
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Name <span style="color:red;font-weight:bold">*</span></label>
            <input type="text" id="form1Example1" class="form-control" placeholder="Enter name participant" required/>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Email <span style="color:red;font-weight:bold">*</span></label>
            <input type="email" id="form2Example1" class="form-control" placeholder="Enter email participant" required/>
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="width:100%;">ADD PARTICIPANT</button>
    </form>
    <h2 class="my-2 py-2">Participant</h2>
    <div class="d-flex flex-wrap justify-content-around">
        <div class="card shadow-sm p-3 mb-5 bg-white rounded" style="width: 100%;margin-bottom: 1rem;">
            <div class="card-body">
                <p class="card-text">Name : <span>Fast Voting User</span></p>
                <p class="card-text">Email : <span>fastVoting@xxx.com</span></p>
                <a href="#" class="btn btn-danger">Delete</a>
            </div>
        </div>
        <div class="card shadow-sm p-3 mb-5 bg-white rounded" style="width: 100%;margin-bottom: 1rem;">
            <div class="card-body">
                <p class="card-text">Name : <span>Fast Voting User</span></p>
                <p class="card-text">Email : <span>fastVoting@xxx.com</span></p>
                <a href="#" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
