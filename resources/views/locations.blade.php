@extends("layouts.app")
@section("id", "locations")
@section('content')
    <section class="restaurant">
        <div class="container">
            <select class="form-control" name="state" id="state">
                <option value="none">Select your state</option>
                @foreach ($states as $state)
                    <option value="{{ $state->name }}" state_id="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
            <select class="form-control" name="city" id="city">
                <option value="none">Select your city</option>
            </select>
            <select class="form-control" name="restaurant" id="restaurant">
                <option value="none">Select a restaurant</option>
            </select>
            <div id="map" class="map"></div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkaz16yOuXrSNG6fQfk0DFUXqOsto4F9g"
    async defer></script>
@endsection