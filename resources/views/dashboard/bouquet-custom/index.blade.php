@extends('dashboard.master.main')
@section('title', 'Data Bouquet Customs')
@section('content')
<section class="section">
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-content p-2">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('create-bouquet-custom') }}" class="btn btn-primary m-2">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Toppings</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($bouquetCustom as $bouquet)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td><img src="{{ asset('storage/' . $bouquet->image) }}" alt="{{ $bouquet->name }}"
                                             width="200"></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
