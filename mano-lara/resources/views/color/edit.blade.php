@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Color</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('colors-update', $color)}}" method="post">
                        <div class="form-group">
                            <label>Color name</label>
                            <input class="form-control" type="text" name="color_title" value="{{$color->title}}" />
                        </div>
                        <div class="form-group">
                            <label class="mt-2">Color</label>
                            <input class="form-control" type="color" name="create_color_input" value="{{$color->color}}" />
                        </div>
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-success mt-4" type="submit">Ja, ja, this is new color</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
