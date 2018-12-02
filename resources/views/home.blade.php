@extends("layouts.app")
@section('id', "home")
@section('header')
<section class="landing">
    <img src="/img/logo.png" alt="">
    <h1>Resturant</h1>
</section>
@endsection
@section('content')
    <section id="popular">
        @foreach ($dishes as $dish)
        <a class="dish" href="/menu/{{ $dish->name }}">
            <h3>{{ $dish->name }}</h3>
            <img src="{{ \Storage::disk('s3')->url($dish->image) }}" alt="">
        </a>
        @endforeach
    </section>
    @include("incs.footer")
@endsection