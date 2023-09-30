@extends('pages.master.main')
@section('title','Keranjang')
@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-content p-4">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bouquet Image</th>
                                    <th scope="col">Bouquet Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach ($carts as $cart)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td><img src="/storage/{{ $cart->bouquet->image }}" alt="{{ $cart->bouquet->name }}" width="300"></td>
                                    <td class="text-bold-500">{{ $cart->bouquet->name }}</td>
                                    <td>
                                        <form action="{{route('destroy-cart',$cart->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <form action="{{route('create-order')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$cart->bouquet->id}}">
                                            <button type="submit" class="btn btn-success">Checkout</button>
                                        </form>
                                    </td>
                                </tr>
                                @php($i++)
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
