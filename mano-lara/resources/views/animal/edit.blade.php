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
                    <form action="{{route('animals-update', $animal)}}" method="post">
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
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-success mt-4" type="submit">Ja, I wish so</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


