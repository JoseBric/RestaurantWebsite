@extends("layouts.app")
@section("id", "admin")
@section("content")
    <div class="container">
        @include('messages.messages')
        @include("messages.errors")
        <h1>
            Admin Dashboard
        </h1>
        <br>
        <a class="btn btn-secondary add-dish btn-lg float-left mr-3 mb-5" href="/admin/create">Add A Dish</a>
        <form class="form-inline float-left" action="/admin/category" method="POST">
            @csrf
            <input class="form-control" type="text" name="category_name" id="name" class="form-control">
        </form>
        @if (isset($tags))
            @foreach ($tags as $tag)
                <span class="badge badge-secondary tags" category_id="{{ $tag->id }}" style="cursor: pointer; margin: 5px 0 5px 10px; font-family: Nunito; font-size: 1rem;">{{ $tag->category_name }}</span>
            @endforeach
        @endif
        <div class="images row" style="clear: both;">
            @foreach ($dishes as $dish)
            <div class="card dish col-md-4" dish_id="{{ $dish->id }}">
                <img src="{{ \Storage::disk("s3")->url($dish->image) }}" alt="" class="card-img-top mt-3" style="margin: auto; width: 90%">
                <div class="card-body">
                    <div class="card-header">
                        <div class="card-title text-center text-capitalize">
                            <h2>{{ $dish->name }}</h2>
                        </div>
                    </div>
                    <br>
                    <div class="card-text text-center description">
                        <h4 class="card-subtitle mb-2 text-muted">Ingredients:</h4>
                        <p>{{ $dish->description }}</p>
                    </div>
                    <div class="text-center">
                        <button class="mr-1 btn btn-danger btn-lg deleteBtn">Delete</button>
                        <a class="btn btn-primary ml-1 btn-lg" href="/admin/{{ $dish->id }}/edit">Update</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@section("script")
<script>
</script>
@endsection