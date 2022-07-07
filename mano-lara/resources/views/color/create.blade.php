@extends('main')

@section('content')
<ul>
    <form action="{{route('colors-store')}}" method="post">
    <input type="color" name="create_color_input" />
    @csrf
    <button type="submit">Ja, ja, nice color</button>
    </form>
</ul>
@endsection