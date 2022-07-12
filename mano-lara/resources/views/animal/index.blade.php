@extends('main')

@section('content')
<a href="{{route('animals-index', ['sort' => 'asc'])}}">A-Z</a>
<a href="{{route('animals-index', ['sort' => 'desc'])}}">Z-A</a>
<a href="{{route('animals-index')}}">Reset</a>
<ul>
    @forelse($animals as $animal)
    <li>
        <div class="color-box" style="background:{{$animal->getThisAnimalsColor_plese->color}};">
        {{$animal->getThisAnimalsColor_plese->title}}
        <h2>{{$animal->name}}</h2>
    </div>
        <div class="controls">
        <a href="{{route('animals-show', $animal->id)}}">SHOW</a>
        <a href="{{route('animals-edit', $animal)}}">EDIT</a>
        <form class="delete" action="{{route('animals-delete', $animal)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Kill</button>
        </form>
    </div>
    </li>
    @empty
    <li>No animals, no life.</li>
    @endforelse
</ul>

@endsection
