@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background:{{$animal->getThisAnimalsColor_plese->color}};">
                    <h1 class="nice">{{$animal->name}}</h1>
                </div>
                <div class="card-body">
                <div class="color-bin">
                    <div class="controls">
                        <a class="btn btn-outline-success m-2" href="{{route('animals-edit', $animal)}}">Edit</a>
                        <form class="delete" action="{{route('animals-delete', $animal)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger m-2">Destroy</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection