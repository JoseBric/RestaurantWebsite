@extends("layouts.app")
@section("id", "dashboard")
@section("content")
    <div class="container">
        @include('messages.messages')
        @include("messages.errors")
        <h1>
            Dishes Dashboard
        </h1>
        <br>
        <a class="btn btn-secondary add-dish btn-lg mr-3 mb-5" href="/dish/create">Add A Dish</a>
        <div class="images row">
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
                        <a class="btn btn-primary ml-1 btn-lg" href="/dish/{{ $dish->id }}/edit">Update</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        {{ $dishes->links() }}
    </div>
@endsection
@section("script")
<script>
</script>
@endsection