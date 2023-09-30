@extends('pages.master.main')
@section('title','Bouquet Custom')
@section('content')
    <a href="{{route('create-bouquet-custom')}}" class="btn btn-primary w-25 mb-3">Buat Bouquet Custom</a>
    <table class="table table-striped">
        <thead class="table-primary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Bouquet Image</th>
            <th scope="col">Bouquet Name</th>
            <th scope="col">Description</th>
            <th scope="col">Toppings</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($bouquetCustom as $bouquet)
            <tr>
                <th scope="row">{{$i}}</th>
                <td><img src="{{ asset('storage/' . $bouquet->image) }}" alt="{{ $bouquet->name }}"
                         width="150"></td>
                <td>{{$bouquet->name}}</td>
                <td>{{$bouquet->desc}}</td>
                <td>
                    @php($orderToppings = json_decode($bouquet->toppings, true))
                    @foreach($toppings as $topping)
                        @foreach($orderToppings as $order_topping)
                            @if($order_topping['id'] == $topping->id)
                                {{$topping->name}} ({{$order_topping['total']}}),
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td>{{$bouquet->price}}</td>
                <td>
                    <form action="{{route('order-bouquet-custom')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$bouquet->id}}">
                        <button type="submit" class="btn btn-success">Checkout</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('destroy-bouquet-custom',$bouquet->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @php($i++)
        @endforeach
        </tbody>
    </table>
@endsection
