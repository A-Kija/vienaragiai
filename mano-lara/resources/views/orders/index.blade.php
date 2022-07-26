@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orders</div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($orders as $order)
                        <li class="list-group-item">
                            <div class="color-box2" style="background:{{$order->animal->getThisAnimalsColor_plese->color}}">
                                <i>{{$order->animal->getThisAnimalsColor_plese->title}}</i>
                                <h2>{{$order->animal->name}}: <small>{{$order->count}} units</small></h2>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No orders, go to order something!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection