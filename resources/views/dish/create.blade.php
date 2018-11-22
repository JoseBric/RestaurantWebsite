@extends('layouts.app')
@section("id", "dish_create")
@section('content')
    <div class="container">
        @include('messages.messages')
        @include("messages.errors")
        <a href="/dish" class="btn btn-secondary">Back</a>
        <h1>Add a new dish to the menu</h1>
        <form class="form-inline float-left row col-md-12" id="form_dish" action="/dish/category" method="POST">
            @csrf
            <input class="form-control" type="text" placeholder="New food category" name="category_name" id="name" class="form-control">
            <input type="checkbox" class="ml-3 mr-2" id="delete-tags">
            <label for="delete-tags"><span class="text-muted">Delete Categories</span></label>
        </form>
        
        <form action="{{ route('dish.store') }}" enctype="multipart/form-data" method="post">
            @if (isset($tags))
            <div class="form-group">
                <label for="tags">
                    @foreach ($tags as $tag)
                    <label class="badge badge-secondary tags" category_id="{{ $tag->id }}" for="{{ $tag->id }}">
                        <span>{{ $tag->category_name }}</span>
                        <input id="{{ $tag->id }}" class="selectTag" type="checkbox" name="category[]" value="{{ $tag->id }}">
                    </label>
                    @endforeach
                </label>
            </div>
            @endif
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