@if(session()->has("success"))
    <div class="alert alert-success">
        <p>
            {{ session("success") }}
        </p>
    </div>
@endif

@if(session()->has("warning"))
    <div class="alert alert-warning">
        <p>
            {{ session("warning") }}
        </p>
    </div>
@endif

@if(session()->has("danger"))
    <div class="alert alert-danger">
        <p>
            {{ session("danger") }}
        </p>
    </div>
@endif