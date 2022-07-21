@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add Color</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('colors-store')}}" method="post">
                        <div class="form-group">
                            <label>Color name</label>
                            <input class="form-control" type="text" name="color_title" value="{{old('color_title')}}" />
                        </div>
                        <div class="form-group">
                            <label class="mt-2">Color</label>
                            <input class="form-control" type="color" name="create_color_input" value="{{old('create_color_input')}}" />
                        </div>
                        @csrf
                        @method('post')
                        <button class="btn btn-outline-success mt-4" type="submit">Ja, ja, nice color</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
