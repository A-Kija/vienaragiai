@extends('main')

@section('content')
<ul>
    <li>
        <div class="color-box" style="background:{{$color->color}};">
        {{$color->color}}
        <h2>{{$color->title}}</h2>
    </div>
        <div class="controls">
        <a href="{{route('colors-edit', $color)}}">EDIT</a>
        <form class="delete" action="{{route('colors-delete', $color)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Destroy</button>
        </form>
    </div>
    </li>
</ul>

@endsection
