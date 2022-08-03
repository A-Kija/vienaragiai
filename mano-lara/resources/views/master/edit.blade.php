@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add Skills to {{$master->master_name}}</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('masters-update', $master)}}" method="post">

                        @foreach($skills as $key => $skill)
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" value="{{$skill->id}}" name="skill[]" id="_{{$key}}">
                            <label class="form-check-label" for="_{{$key}}">{{$skill->skill}}</label>
                        </div>
                        @endforeach

                        @csrf
                        @method('put')
                        <button class="btn btn-outline-success mt-4" type="submit">Ja, ja, this is new master's skills</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
