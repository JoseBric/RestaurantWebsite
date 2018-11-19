@extends('layouts.app')
@section('content')
    <div class="container">
        @include('messages.messages')
        @include("messages.errors")
        <h1>Update a dish</h1>
        <form action="{{ route('admin.update', $dish->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method("put")
            <div class="form-group">
                <img style="width: 33%; height: auto; display: block;" src="{{ \Storage::disk("s3")->url($dish->image) }}" alt="">
                <br>
                <label for="file">Update image</label>
                <input type="file" name="file" id="file" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $dish->name }}" placeholder="Write the name of the dish" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" value="{{ $dish->description }}" name="description" placeholder="Write the description of the dish" class="form-control">
            </div>
            <input class="btn btn-primary" type="submit">
        </form>
    </div>
@endsection