@extends("layouts.app")
@section('id', "menu")
@section('content')
    <div class="container">
        <div class="dishes-menu">
            @foreach ($categories as $category)
            @if($category->dishes()->first())
            @php
                $image = \Storage::disk("s3")->url($category->dishes()->first()->image);
            @endphp
            <a class="dish" href="/menu/{{ $category->category_name }}/category">
                <h3><span>{{ $category->category_name }}</span></h3>
                <div class="img" style="background: url({{ $image }}); background-size: cover;"></div>
            </a>
            @endif
        @endforeach
        </div>
    </div>
@endsection