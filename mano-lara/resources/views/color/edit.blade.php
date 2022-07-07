@extends('main')

@section('content')
<ul>
    <form action="{{route('colors-update', $color)}}" method="post">
    <input type="color" name="create_color_input" value="{{$color->color}}" />
    @csrf
    @method('put')
    <button type="submit">Ja, ja, this is new color</button>
    </form>
</ul>
@endsection