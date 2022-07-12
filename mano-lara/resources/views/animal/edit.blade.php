@extends('main')

@section('content')
<ul>
    <form action="{{route('animals-update', $animal)}}" method="post">
    <input type="text" name="animal_name" value="{{$animal->name}}" />
    <select name="color_id">
        @foreach($colors as $color)
            <option value="{{$color->id}}" @if($color->id == $animal->color_id)selected @endif>{{$color->title}}</option>
        @endforeach
    </select>
    @csrf
    @method('put')
    <button type="submit">Ja, I wish so</button>
    </form>
</ul>
@endsection