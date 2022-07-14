@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My fantastic Zoo</div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($animals as $animal)
                        <li class="list-group-item">
                            <div class="color-box2" style="background:{{$animal->getThisAnimalsColor_plese->color}};">
                                <i>{{$animal->getThisAnimalsColor_plese->title}}</i>
                                <h2>{{$animal->name}}</h2>
                            </div>
                            <div class="controls">
                                <a class="btn btn-outline-primary m-2" href="{{route('animals-show', $animal->id)}}">Show</a>
                                <a class="btn btn-outline-success m-2" href="{{route('animals-edit', $animal)}}">Edit</a>
                                <form class="delete" action="{{route('animals-delete', $animal)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger m-2">Destroy</button>
                                </form>
                            </div>

                        </li>
                        @empty
                        <li class="list-group-item">No animals, no life.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
