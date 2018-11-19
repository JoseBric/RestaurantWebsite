@extends('layouts.app')
@section('content')
    <div class="container">
        @include('messages.messages')
        @include("messages.errors")
        <h1>Add a new dish to the menu</h1>
        <form action="{{ route('admin.store') }}" enctype="multipart/form-data" method="post">
            <div class="form-group">
                @csrf
                <label for="file">Upload a file</label>
                <input type="file" name="file" id="file" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Write the name of the dish" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" placeholder="Write the description of the dish" class="form-control">
            </div>
            <input class="btn btn-primary" type="submit">
        </form>
    </div>
@endsection