@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
@endif
@if(session('deleted'))
        <div class="alert alert-deleted">
            {{ session('deleted') }}
        </div>
@endif