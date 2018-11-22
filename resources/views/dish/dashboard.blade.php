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
            <a class="btn btn-secondary add-dish btn-lg mr-3 mb-5" href="/dish/create">Add A Dish</a>
            <div class="tags-container">
                @if (isset($tags))
                    @foreach ($tags as $tag)
                    @if(!empty($tag->dishes[0]))
                        <a href="/dish/category/{{ $tag->id }}" class="mt-2 tags badge badge-secondary"><span>{{ $tag->category_name }}</span></a>
                    @endif
                    @endforeach
                @endif
            </div>
        </div>
            <div class="images row">
                @foreach ($dishes as $dish)
                    @include("incs.dish")
                @endforeach
            </div>
        {{ $dishes->links() }}
    </div>
@endsection
@section("script")
<script>
</script>
@endsection