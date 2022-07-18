@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('front.box')
            <div class="card">
                <div class="card-header">My fantastic Zoo</div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($animals as $animal)
                        <li class="list-group-item">
                            <div class="color-box2" style="background:{{$animal->color}};">
                                <i>{{$animal->title}}</i>
                                <h2>{{$animal->name}}</h2>
                            </div>
                            <div class="controls">
                                <form class="delete" action="" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-warning m-2">Want it!</button>
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
