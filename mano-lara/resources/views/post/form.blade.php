@extends('main')

@section('content')
@if($ro !== '')
<h1>REZULTATAS: {{$ro}}</h1>
@endif
<form action="{{route('skaiciuokle')}}" method="POST">
X: <input type="text" name="x" />
Y: <input type="text" name="y" />
@csrf
<button type="submit">skirtumas</button>
</form>
<ul>
@foreach($colors as $color)
    @include('post.li')
@endforeach
</ul>
@endsection

@section('title')
Bla Bla here we go!
@endsection
