@extends('dashboard.master.main')
@section('title', 'Data Order')
@section('content')
    <table class="table table-striped" aria-label="Table Order">
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
        @foreach($orders as $order)
            @php($orderStatus = $order->order_status)
            <tr>
                <th scope="row">1</th>
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
                <td>
                    {{$order->payment_status}}
                </td>
                <td>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
