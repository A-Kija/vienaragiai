<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if(session('deleted'))
            <div class="alert alert-warning">
                {{ session('deleted') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
