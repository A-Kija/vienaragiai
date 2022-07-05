@if($ro !== '')
<h1>REZULTATAS: {{$ro}}</h1>
@endif
<form action="{{route('skaiciuokle')}}" method="POST">
X: <input type="text" name="x" />
Y: <input type="text" name="y" />
@csrf
<button type="submit">skirtumas</button>
</form>
