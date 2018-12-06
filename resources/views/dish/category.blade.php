@extends("layouts.app")
@section("id", "dish_category")
@section("content")
<div class="container">
    <a href="/dish" class="btn btn-secondary btn-lg">Back</a>
    <br>
    <div class="dishes row">
        @foreach ($dishes as $dish)
        @include("incs.dish")
        @endforeach
    </div>
</div>
@endsection