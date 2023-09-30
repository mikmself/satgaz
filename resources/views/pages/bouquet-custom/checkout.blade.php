@extends('pages.master.main')
@section('title', 'Buat Pesanan Bouquet Custom')
@section('content')
    <style>
        .card-body.active {
            border: 1px solid #435ebe;
            border-radius: 10px;
            box-shadow: 0 0 5px #435ebe;
        }
    </style>
    <form method="POST" action="{{ route('store-order') }}">
        @csrf
        @method('POST')
        <div class="bg-white p-4">
            <h3>Create Order</h3>
            <input type="hidden" name="bouquet_custom_id" value="{{ $bouquet->id }}">
            <div class="mb-3 mt-3">
                <label for="bouquet-name" class="form-label">Bouquet Name</label>
                <input type="text" class="form-control" id="bouquet-name" value="{{ $bouquet->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="bouquet-price" class="form-label">Bouquet Price</label>
                <input type="text" class="form-control" id="bouquet-price" value="{{ $bouquet->price }}" disabled>
            </div>
            <div class="mb-3">
                <label for="customer-name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customer-name" value="{{ auth()->user()->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="total_order" class="form-label">Total Order</label>
                <input type="number" class="form-control" id="total_order" name="total_order" value="1" min="1">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
@endsection
