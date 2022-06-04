@extends('layouts.app')

@section('content')

<div class="col-lg-8">
    <form method="post" action="/events/options" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="image_location" class="form-label">Foto</label>
            <input class="form-control" type="file" id="image_location" name="image_location">
        </div>
        <button type="submit" class="btn btn-primary">add option</button>
    </form>
</div>

@endsection
