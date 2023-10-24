<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\BouquetCustom;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with(['user','bouquet','bouquetCustom'])->get();
        $toppings = Topping::all();
        return view('dashboard.order.index',compact('orders','toppings'));
    }
    public function show($id)
    {
        $order = Order::where('id',$id)->first();
        $toppings = Topping::all();
        $snapToken = $order->snap_token;
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        if (empty($snapToken)) {
            $params = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->telephone,
                ]
            ];
            $snapToken = Snap::getSnapToken($params);
            $order->snap_token = $snapToken;
            $order->save();
        }
        return view('pages.order.show', compact('order', 'snapToken','toppings'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'total_order' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $bouquet = Bouquet::whereId($request->input('bouquet_id'))
            ->first() ?? BouquetCustom::whereId($request->input('bouquet_custom_id'))
            ->first();
        $total_price = $bouquet->price * $request->input('total_order');
        $toppings_data = [];
        if($request->input('toppings') !== null){
            foreach ($request->input('toppings') as $topping){
                if(isset($topping['status'])){
                    $data_toping = Topping::where('id',$topping['id'])->first();
                    $total_price += $data_toping->price * $topping['total'];
                    $store_topping = [
                        'id' => $topping['id'],
                        'total' => $topping['total']
                    ];
                    array_push($toppings_data,$store_topping);
                }
            }
        }
        $created = Order::create([
            'id' => Str::uuid(),
            'owner_id' => auth()->user()->id,
            'bouquet_id' => $request->input('bouquet_id') ?? null,
            'bouquet_custom_id' => $request->input('bouquet_custom_id') ?? null,
            'toppings' => $toppings_data ? json_encode($toppings_data) : null,
            'total_order' => $request->input('total_order'),
            'total_price' => $total_price,
        ]);
        if($created){
            return redirect()
                ->to(route('home'))
                ->with('success','Order telah berhasil dibuat, silahkan bayar dp untuk proses selanjutnya');
        }else{
            return back()->with('error','Order gagal dibuat, kesalahan pada server!');
        }
    }

    public function applyDiscount(Request $request){
        $order = Order::whereId($request->order_id)->first();
        $discount = Discount::where('code',$request->input('code'))->first();
        if(isset($discount)){
            $total_discount = $order->total_price * ($discount->discount / 100);
            $new_total_price = $order->total_price - $total_discount;
            $order->update([
                'discount' => $discount->code,
                'total_price' => $new_total_price
            ]);
            if($discount->limit !== null){
                if($discount->limit < 1){
                    return back()->with('error','Kode diskon sudah melebihi limit');
                }
                $discount->update([
                    'limit' => $discount->limit - 1
                ]);
            }
            return back()->with('success','Kode diskon berhasil dipakai');
        }else{
            return back()->with('error','Kode diskon tidak tersedia');
        }
    }
}
