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
        <div class="row">
            <a class="btn btn-secondary add-dish btn-lg mr-3 mb-3" href="/dish/create">Add A Dish</a>
            <div class="tags-container">
                @if (isset($tags))
                    @foreach ($tags as $tag)
                    @if(!empty($tag->dishes[0]))
                        <a href="/dish/category/{{ $tag->id }}" class="mt-2 tags badge badge-secondary"><span>{{ $tag->category_name }}</span></a>
                    @endif
                    @endforeach
                @endif
            </div>
            <div class="featured-dishes col-md-12 row mb-4">
                <input type="checkbox" id="featuredBox">
                <label for="featuredBox">Select Featured <span id="featured-badge" class="badge badge-secondary featured-badge">{{ count($featured) }}</span></label>
            </div>
        </div>
        </div>
            <div class="images row">
                @foreach ($dishes as $dish)
                    @if ($dish->featured)
                    @include("incs.featuredDish")
                    @else
                    @include("incs.dish")
                    @endif
                @endforeach
            </div>
        {{ $dishes->links() }}
    </div>
@endsection
@section("script")
<script>
</script>
@endsection