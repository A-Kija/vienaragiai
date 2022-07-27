@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Animal Create</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('animals-store')}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Animal name</label>
                            <input class="form-control" type="text" name="animal_name" />
                        </div>
                        <div class="form-group">
                            <label>What color?</label>
                            <select class="form-control" name="color_id">
                                @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->title}}</option>
                                @endforeach
                            </select>
                            <div class="m-2">
                            <a class="magic--link" href="">see <span><span></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Portret of animal</label>
                            <input class="form-control" type="file" name="animal_photo" />
                        </div>
                        @csrf
                        @method('post') 
                        <button class="btn btn-outline-success mt-4" type="submit">I found Animal!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
