@if(session()->has("success"))
    <div class="alert alert-success">
        <h3>
            {{ session("success") }}
        </h3>
    </div>
@endif

@if(session()->has("warning"))
    <div class="alert alert-warning">
        <h3>
            {{ session("warning") }}
        </h3>
    </div>
@endif

@if(session()->has("danger"))
    <div class="alert alert-danger">
        <h3>
            {{ session("danger") }}
        </h3>
    </div>
@endif