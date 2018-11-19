@extends("layouts.app")
@section("content")
    <div class="container">
        @include('messages.messages')
        @include("messages.errors")
        <form action="{{ route('update_user_settings', Auth::user()->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" readonly value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" readonly value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="name">Password</label>
                <input type="password" id="name" name="name" class="form-control" readonly value="stopeditingtheinputtype" required>
            </div>
            <a class="btn btn-secondary" href="/user/{{ $user->id }}/settings">Edit</a>
            <br>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
@endsection