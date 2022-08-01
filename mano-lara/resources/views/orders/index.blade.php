@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse($orders as $order)
            <div class="card mt-3">
                <div class="card-header">Order from: {{$order->client->name}}</div>
                <div class="card-body">
                    <ul class="list-group">

                        @forelse($order->animals as $animal)
                        <li class="list-group-item">

                            <div class="color-box2" style="background:{{$animal->getThisAnimalsColor_plese->color}}">
                                <i>{{$animal->getThisAnimalsColor_plese->title}}</i>
                                <h2>{{$animal->name}}: <small>{{$animal->count}} units</small></h2>
                            </div>

                        </li>
                        @endforeach
                        <li class="list-group-item">
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
                                                        <option value="{{$key}}" @if($key==$order->status) selected @endif>{{$status}}</option>
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
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @empty
            <div>No orders, go to order something!</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
