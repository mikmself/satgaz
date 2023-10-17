<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .detail-card {
            background-color: #f9f9f9;
            border: 1px solid #d9d9d9;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Detail Order</h1>
    <div class="row">
        <div class="col-md-9">
            <div class="detail-card">
                <p><strong>ID:</strong> {{ $order->id }}</p>
                <p><strong>Toppings:</strong>
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
                </p>
                <p><strong>Total Price:</strong> {{ $order->total_price }}</p>
                <p><strong>Total Order:</strong> {{ $order->total_order }}</p>
                <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
                <p><strong>Created At:</strong> {{ $order->created_at }}</p>
            </div>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
            <div class="detail-card">
                @isset($order->bouquet->image)
                    <img src="{{ asset('storage/' . $order->bouquet->image) }}" alt="{{ $order->bouquet->name}}" width="280">
                @endisset
                @isset($order->bouquetCustom->image)
                    <img src="{{ asset('storage/' . $order->bouquetCustom->image) }}" alt="{{ $order->bouquetCustom->name }}" width="280">
                @endisset
            </div>
        </div>
    </div>
    <div class="col-md-12">
        @if ($order->payment_status == 'unpaid')
            <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
        @else
            <p class="text-success">Pembayaran berhasil</p>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log(result)
            },
            onPending: function(result) {
                console.log(result)
            },
            onError: function(result) {
                console.log(result)
            }
        });
    });
</script>
</body>
</html>
