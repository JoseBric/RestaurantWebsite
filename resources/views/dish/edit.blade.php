@extends('layouts.app')
@section("id", "dish_edit")
@section('content')
    <div class="container">
        @include('messages.messages')
        @include("messages.errors")
        <a href="/dish" class="btn btn-secondary">Back</a>
        <h1>Update a dish</h1>
        <form class="form-inline float-left" id="form_dish" action="/dish/category" method="POST">
            @csrf
            <input class="form-control" type="text" name="category_name" id="name" class="form-control">
        </form>
        <form action="{{ route('dish.update', $dish->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method("put")
            @if (isset($tags))
            <div class="form-group">
                <div class="tags_container">
                    <input type="checkbox" class="ml-3 mr-2" id="delete-tags">
                    @foreach ($tags as $tag)
                    @if(in_array($tag->id, $categories_id))
                    <label class="badge badge-secondary tags added" category_id="{{ $tag->id }}" for="{{ $tag->id }}">
                        <span>{{ $tag->category_name }}</span>
                        <input id="{{ $tag->id }}" class="selectTag" type="checkbox" checked name="category[]" value="{{ $tag->id }}">
                    </label>
                    @else
                    <label class="badge badge-secondary tags" category_id="{{ $tag->id }}" for="{{ $tag->id }}">
                        <span>{{ $tag->category_name }}</span>
                        <input id="{{ $tag->id }}" class="selectTag" type="checkbox" name="category[]" value="{{ $tag->id }}">
                    </label>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
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