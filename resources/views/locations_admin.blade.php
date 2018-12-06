@extends("layouts.app")
@section("id", "locations_admin")
@section('content')
<div class="container">
    @include("messages.errors")
        <h1>Add Restaurant Location</h1>
        <form action="/locations/admin" method="POST">
            @csrf
            <div class="from-group">
                <label for="state">State</label>
                <input type="text" id="state" class="form-control" name="state">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" class="form-control" name="city">
            </div>
            <div class="form-group">
                <label for="zipcode">Zip Code</label>
                <input type="number" id="zipcode" class="form-control" name="zipcode">
            </div>
            <div class="form-group">
                <label for="street">Street</label>
                <input type="text" id="street" class="form-control" name="street">
            </div>
            <div class="form-group">
                <label for="ext_num">External Number</label>
                <input type="text" id="ext_num" class="form-control" name="ext_num">
            </div>

            <div class="form-group">
                <label for="lat">Latitude</label>
                <input type="text" id="lat" class="form-control" name="lat">
            </div>

            <div class="form-group">
                <label for="lng">Longitude</label>
                <input type="text" id="lng" class="form-control" name="lng">
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
@endsection