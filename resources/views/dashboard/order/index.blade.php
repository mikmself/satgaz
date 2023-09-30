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
                    @if(substr($orderStatus,0,22) === "Anda harus membayar dp")
                        Menunggu DP dari User
                    @elseif(substr($orderStatus,0,31) === "Pesanan telah selesai, silahkan")
                        Menunggu pelunasan dari User
                    @elseif(substr($orderStatus,0,14) === "DP tidak valid")
                        Menunggu DP ulang dari user
                    @elseif(substr($orderStatus,0,21) === "Pelunasan tidak valid")
                        Menunggu Pelunasan ulang dari user
                    @else
                        {{$order->order_status}}
                    @endif
                </td>
                <td>
                    @if($orderStatus === "DP telah diupload, menunggu konfirmasi dari admin.")
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#dpModal{{$order->id}}">
                            Show DP
                        </button>
                        <a href="{{route('accDP',$order->id)}}" class="btn btn-primary">Acc DP</a>
                        <a href="{{route('cancelDP',$order->id)}}" class="btn btn-danger">Cancel DP</a>
                    @elseif($orderStatus === "Pelunasan telah diupload, menunggu konfirmasi dari admin.")
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#repaymentModal{{$order->id}}">
                            Show Repayment
                        </button>
                        <a href="{{route('accRepayment',$order->id)}}" class="btn btn-primary">Acc Repayment</a>
                        <a href="{{route('cancelRepayment',$order->id)}}" class="btn btn-danger">Cancel Repayment</a>
                    @elseif($orderStatus === "Bouquet sedang dalam proses pengerjaan.")
                        <a href="{{route('halfFinish',$order->id)}}" class="btn btn-warning">Buket Jadi</a>
                    @elseif($orderStatus === "Bouquet akan segera dikirim!.")
                        <a href="{{route('finish',$order->id)}}" class="btn btn-success">Selesai</a>
                    @endif
                </td>
            </tr>
            <div class="modal fade" id="dpModal{{$order->id}}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel"> DP Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="/storage/{{$order->dp_image}}" class="img-fluid" alt=" DP Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="repaymentModal{{$order->id}}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Repayment Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="/storage/{{$order->repayment_image}}" class="img-fluid" alt="Repayment Image">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
