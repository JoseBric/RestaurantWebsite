@extends("layouts.app")
@section("content")
    <div class="container">
        @include('messages.messages')
        @include("messages.errors")
        <form action="{{ route('update_user_settings', Auth::user()->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Write your new password">
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input type="password" id="password-confirm" name="password_confirmation" placeholder="Write again the password" class="form-control">
            </div>
            <a href="/user/{{ $user->id }}" class="btn btn-secondary">Back</a>
            <br>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
@endsection