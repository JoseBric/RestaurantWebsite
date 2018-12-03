<div class="card dish col-md-4">
    <img src="{{ \Storage::disk("s3")->url($dish->image) }}" alt="" class="card-img-top mt-3" style="margin: auto; width: 90%">
    <div class="card-body">
        <div class="card-header">
            <div class="card-title text-center text-capitalize">
                <h2>{{ $dish->name }}</h2> <input dish_id="{{ $dish->id }}" type="checkbox" name="featured" class="featuredBox">
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