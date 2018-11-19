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
        <h2>Popular Dishes</h2>
        <div class="dish">
            <h3>Pizza</h3>
            <img src="{{ asset('img/menu/pizza.jpeg') }}" alt="">
        </div>
        <div class="dish">
            <h3>Lasagna</h3>
            <img src="{{ asset('img/menu/lasagna.jpg') }}" alt="">
        </div>
        <div class="dish">
            <h3>Hamburger</h3>
            <img src="{{ asset('img/menu/burger.jpeg') }}" alt="">
        </div>
        <div class="dish">
            <h3>Beef</h3>
            <img src="{{ asset('img/menu/beef.jpg') }}" alt="">
        </div>
    </section>
    @include("incs.footer")
@endsection