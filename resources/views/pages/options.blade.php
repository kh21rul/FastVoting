@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Option</h2>
    <p class="description-text">add the option to be selected in the vote</p>
    <hr class="ruler">
    <form method="POST" action="#">
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Select Image <span style="color:red;font-weight:bold">*</span></label>
            <input type="file" id="form1Example1" class="form-control" name="selectImage" accept="image/*" required/>
            @error('selectImage')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Name <span style="color:red;font-weight:bold">*</span></label>
            <input type="text" id="form2Example1" class="form-control" name="nameOption" placeholder="Enter name option" required/>
            @error('nameOption')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Description <span style="color:red;font-weight:bold">*</span></label>
            <textarea id="form2Example1" class="form-control" name="descriptionOption" placeholder="Enter desciption option or you can write visi misi in here" required></textarea>
            @error('descriptionOption')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="width:100%;">Add Option</button>
    </form>
    <div class="choice-detailEvent">
        <h3 class="mt-2">Choice options :</h3>
        <div class="d-flex flex-wrap choiceCard">
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <div class="d-flex justify-content-start">
                    <a type="button" class="btn btn-success" href="#" style="margin-right: 1%">Edit Option</a>
                    <a type="button" class="btn btn-danger" href="#">Delete</a>
                  </div>
                </div>
            </div>
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <div class="d-flex justify-content-start">
                    <a type="button" class="btn btn-success" href="#" style="margin-right: 1%">Edit Option</a>
                    <a type="button" class="btn btn-danger" href="#">Delete</a>
                  </div>
                </div>
            </div>
            <div class="card choice" style="margin-bottom: 1rem;">
                <div class="card-head d-flex justify-content-center p-2"><img src="{{asset('assets/imgCandidate.png')}}" alt="" style="width: 90%"></div>
                <div class="card-body">
                  <h5 class="card-title text-center">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <div class="d-flex justify-content-start">
                    <a type="button" class="btn btn-success" href="#" style="margin-right: 1%">Edit Option</a>
                    <a type="button" class="btn btn-danger" href="#">Delete</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
