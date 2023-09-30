@extends('pages.master.main')
@section('title','Home')
@section('content')
    @foreach($bouquets as $bouquet)
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card custom-card mx-auto">
                <img src="/storage/{{$bouquet->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$bouquet->name}}</h5>
                    <b>Rp.{{$bouquet->price}},00</b>
                    <p class="card-text">{{$bouquet->description}}</p>
                    <form action="{{route('create-order')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$bouquet->id}}">
                        <button type="submit" class="btn btn-primary">Beli</button>
                        <a href="{{route('create-cart',$bouquet->id)}}" class="btn btn-success ml-3">Masukan Keranjang</a>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
