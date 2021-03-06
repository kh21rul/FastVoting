@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Option</h2>
    <p class="description-text">Add the option to be selected in the vote</p>
    <hr class="ruler">
    <form action="{{ route('event.detail') }}">
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
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Select Image <span style="color:red;font-weight:bold">*</span></label>
            <input type="file" id="form1Example1" class="form-control" name="selectImage" accept="image/*" required/>
            @error('selectImage')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="width:100%;">Add Option</button>
    </form>
</div>
@endsection
