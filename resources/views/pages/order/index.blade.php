@extends('pages.master.main')
@section('title','Pesanan')
@section('content')
    <table class="table table-striped">
        <thead class="table-primary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Bouquet Image</th>
            <th scope="col">Bouquet Name</th>
            <th scope="col">Topping</th>
            <th scope="col">Total Price</th>
            <th scope="col">Order Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($orders as $order)
            <tr>
                <th scope="row">{{$i}}</th>
                <td>
                    @isset($order->bouquet->image)
                        <img src="{{ asset('storage/' . $order->bouquet->image) }}" alt="{{ $order->bouquet->name}}" width="150">
                    @endisset
                    @isset($order->bouquetCustom->image)
                        <img src="{{ asset('storage/' . $order->bouquetCustom->image) }}" alt="{{ $order->bouquetCustom->name }}" width="150">
                    @endisset
                </td>
                <td>{{$order->bouquet->name ?? $order->bouquetCustom->name}}</td>
                <td>
                    @if($order->toppings !== null)
                        @php($orderToppings = json_decode($order->toppings, true))
                        @foreach($toppings as $topping)
                            @foreach($orderToppings as $order_topping)
                                @if($order_topping['id'] == $topping->id)
                                    {{$topping->name}} ({{$order_topping['total']}}),
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        User tidak menambahkan topping
                    @endif

                </td>
                <td>{{$order->total_price}}</td>
                <td>{{$order->order_status}}</td>
                <td>
                    <a href="{{route('detail-order',$order->id)}}" class="btn btn-success">Detail Order</a>
                </td>
            </tr>
            @php($i++)
        @endforeach
        </tbody>
    </table>
@endsection
