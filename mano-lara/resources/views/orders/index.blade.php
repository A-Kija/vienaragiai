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
                            <div class="right m-2">
                                {{$order->client->name}}
                            </div>
                            <div class="color-box2" style="background:{{$order->animal->getThisAnimalsColor_plese->color}}">
                                <i>{{$order->animal->getThisAnimalsColor_plese->title}}</i>
                                <h2>{{$order->animal->name}}: <small>{{$order->count}} units</small></h2>
                            </div>
                            <div class="controls mt-2">
                                <form class="delete form" action="{{route('orders-status', $order)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>What status?</label>
                                                    <select class="form-control" name="status">
                                                        @foreach($statuses as $key => $status)
                                                        <option value="{{$key}}" @if($key == $order->status) selected @endif>{{$status}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <button type="submit" class="btn btn-outline-info m-4">Set status</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
