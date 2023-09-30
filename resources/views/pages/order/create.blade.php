@extends('pages.master.main')
@section('title', 'Buat Pesanan')
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
            <input type="hidden" name="bouquet_id" value="{{ $bouquet->id }}">
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
            <h2 class="mt-3">Topping</h2>
            <div class="container bg-dark p-3 h-25" style="overflow-y: scroll">
                <div class="row">
                    @foreach($toppings as $index => $topping)
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="topping-{{ $topping->id }}" name="toppings[{{ $index }}][status]">
                                        <label class="form-check-label" for="topping-{{ $topping->id }}">{{ $topping->name }}</label>
                                    </div>
                                    <img src="/storage/{{ $topping->image }}" alt="{{ $topping->name }}" class="img-fluid">
                                    <p>Harga: Rp. {{ $topping->price }}</p>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" name="toppings[{{ $index }}][total]" min="0" value="0" disabled>
                                        <input type="hidden" name="toppings[{{ $index }}][id]" value="{{ $topping->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
    <script>
        const imgElements = document.querySelectorAll(".card-body img");
        for (const imgElement of imgElements) {
            imgElement.addEventListener("click", () => {
                const checkboxElement = imgElement.parentElement.querySelector(".form-check-input");
                const cardBody = imgElement.parentElement;
                if (checkboxElement.checked) {
                    checkboxElement.checked = false;
                    cardBody.classList.remove("active");
                    const inputNumberElement = cardBody.querySelector("input[type='number']");
                    inputNumberElement.setAttribute("disabled", "true");
                } else {
                    checkboxElement.checked = true;
                    cardBody.classList.add("active");
                    const inputNumberElement = cardBody.querySelector("input[type='number']");
                    inputNumberElement.removeAttribute("disabled");
                }
            });
        }
        const checkboxElements = document.querySelectorAll(".form-check-input");
        for (const checkboxElement of checkboxElements) {
            checkboxElement.addEventListener("change", () => {
                const cardBody = checkboxElement.parentElement.parentElement;
                if (checkboxElement.checked) {
                    cardBody.classList.add("active");
                    const inputNumberElement = cardBody.querySelector("input[type='number']");
                    inputNumberElement.removeAttribute("disabled");
                } else {
                    cardBody.classList.remove("active");
                    const inputNumberElement = cardBody.querySelector("input[type='number']");
                    inputNumberElement.setAttribute("disabled", "true");
                }
            });
        }
        const inputNumberElements = document.querySelectorAll(".card-body input");
        for (const inputNumberElement of inputNumberElements) {
            inputNumberElement.addEventListener("focus", () => {
                inputNumberElement.removeAttribute("disabled");
            });
        }
    </script>
@endsection
