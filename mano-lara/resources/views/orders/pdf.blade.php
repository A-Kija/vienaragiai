<h1>Order from: {{$order->client->name}}</h1>
<ul>
@foreach($order->animals as $animal)
<li>
    <div style="background:{{$animal->getThisAnimalsColor_plese->color}}">
        <i>{{$animal->getThisAnimalsColor_plese->title}}</i>
        <h2>{{$animal->name}}: <small>{{$animal->count}} units</small></h2>
    </div>
</li>
@endforeach
</ul>