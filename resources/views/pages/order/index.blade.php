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
                    @if($order->discount === null)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderForm{{$order->id}}">
                            Pakai Diskon
                        </button>
                    @endif
                    <a href="{{route('detail-order',$order->id)}}" class="btn btn-success">Detail Order</a>
                </td>
            </tr>
            @php($i++)
            <div class="modal fade" id="orderForm{{$order->id}}" tabindex="-1" aria-labelledby="orderForm{{$order->id}}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderForm{{$order->id}}Label">Diskon</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('apply-discount')}}" method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <div class="mb-3 mt-3">
                                        <label for="code" class="form-label">Code</label>
                                        <input type="text" class="form-control" id="code" name="code">
                                        <button class="btn btn-primary mt-3">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
@endsection
