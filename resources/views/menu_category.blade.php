@extends("layouts.app")
@section("id", "menu_category")
@section('content')
    <div class="container">
        <div class="dishes-menu">
            @foreach ($dishes as $dish)
                @php
                 $image = \Storage::disk("s3")->url($dish->image);
                 @endphp
                 <div class="dish">
                     <h3><span>{{ $dish->name }}</span></h3>
                     <div class="img" style="background: url({{ $image }}); background-size: cover;"></div>
                     <div class="ingredients">
                         <h4>Ingredients:</h4>
                         <p>
                            {{ $dish->description }}
                        </p>
                     </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection