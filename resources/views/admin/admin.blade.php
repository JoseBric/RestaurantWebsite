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
        <a class="btn btn-secondary add-dish btn-lg" href="/admin/create">Add A Dish</a>
        <div class="images row">
            @foreach ($dishes as $dish)
            <div class="card col-md-4">
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
                        <form style="display: inline" action="{{ action('AdminPagesController@destroy', [$dish->id]) }}" method="post">
                            @csrf    
                            @method("delete")
                            <input type="submit" class="mr-1 btn btn-danger btn-lg" id="" value="Delete">
                        </form>
                        <a class="btn btn-primary ml-1 btn-lg" href="/admin/{{ $dish->id }}/edit">Update</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection