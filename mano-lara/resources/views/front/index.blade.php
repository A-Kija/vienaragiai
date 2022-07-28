@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('front.box')
            <div class="card">
                <div class="card-header">My fantastic Zoo</div>
                <div class="card-body">
                    @include('front.pager')
                    <ul class="list-group">
                        @forelse($animals as $animal)
                        <li class="list-group-item">
                            <div class="color-box2" style="background:{{$animal->color}};">
                                <i>{{$animal->title}}</i>
                                <h2>{{$animal->name}}</h2>
                                <a href="https://www.google.com/search?q={{$animal->name}}+{{$animal->title}}" target="_blank">Go and see</a>
                            </div>
                            @if(Auth::user()?->role > 0)
                            <div class="controls">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-outline-warning m-2 add--cart">Want it!</button>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-control m-2" type="number" style="width:50px;" name="animals_count" />
                                        </div>
                                        <input type="hidden" value="{{$animal->aid}}" name="animal_id">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </li>
                        @empty
                        <li class="list-group-item">No animals, no life.</li>
                        @endforelse
                    </ul>
                </div>
                @include('front.pager')
            </div>
        </div>
    </div>
</div>
@endsection
