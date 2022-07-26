@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Animal Edit</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('animals-update', $animal)}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Animal name</label>
                            <input class="form-control" type="text" name="animal_name" value="{{$animal->name}}" />
                        </div>
                        <div class="form-group">
                            <label>What color?</label>
                            <select class="form-control" name="color_id">
                                @foreach($colors as $color)
                                <option value="{{$color->id}}" @if($color->id == $animal->color_id)selected @endif>{{$color->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($animal->photo)
                        <div class="image-box">
                            <img src="{{$animal->photo}}">
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Portret of animal</label>
                            <input class="form-control" type="file" name="animal_photo" />
                        </div>
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-success mt-4" type="submit">Ja, I wish so</button>
                    </form>
                    @if($animal->photo)
                    <form action="{{route('animals-delete-picture', $animal)}}" method="post">
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-danger mt-4" type="submit">Dont like picture</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
