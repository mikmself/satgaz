<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\BouquetCustom;
use App\Models\Order;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with(['user','bouquet','bouquetCustom'])->get();
        $toppings = Topping::all();
        return view('dashboard.order.index',compact('orders','toppings'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'total_order' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $bouquet = Bouquet::whereId($request->input('bouquet_id'))->first() ?? BouquetCustom::whereId($request->input('bouquet_custom_id'))->first();
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
        $dp = $total_price * 0.3;
        $order_status = "Anda harus membayar dp sebesar Rp." . number_format($dp, 2);
        $created = Order::create([
            'id' => Str::uuid(),
            'owner_id' => auth()->user()->id,
            'bouquet_id' => $request->input('bouquet_id') ?? null,
            'bouquet_custom_id' => $request->input('bouquet_custom_id') ?? null,
            'toppings' => $toppings_data ? json_encode($toppings_data) : null,
            'total_price' => $total_price,
            'order_status' => $order_status,
            'total_order' => $request->input('total_order')
        ]);
        if($created){
            return redirect()
                ->to(route('home'))
                ->with('success','Order telah berhasil dibuat, silahkan bayar dp untuk proses selanjutnya');
        }else{
            return back()->with('error','Order gagal dibuat, kesalahan pada server!');
        }
    }
    public function accDP($id){
        $acc = Order::whereId($id)->update([
            'order_status' => 'Bouquet sedang dalam proses pengerjaan.'
        ]);
        if($acc){
            return back()->with('success','DP telah berhasil di acc');
        }else{
            return back()->with('error','Sesuatu terjadi, kesalahan pada server!');
        }
    }
    public function cancelDP($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan');
        }
        if (!empty($order->dp_image)) {
            Storage::delete('storage/' . $order->dp_image);
        }
        $dp = $order->total_price * 0.3;
        $cancel = $order->update([
            'order_status' => 'DP tidak valid, silakan upload ulang DP sebesar Rp.' .$dp."!.",
            'dp_image' => null,
        ]);
        if ($cancel) {
            return back()->with('success', 'DP telah berhasil di cancel');
        } else {
            return back()->with('error', 'Sesuatu terjadi, kesalahan pada server!');
        }
    }

    public function halfFinish($id){
        $order = Order::whereId($id)->first();

        if (!$order) {
            return back()->with('error','Pesanan tidak ditemukan.');
        }

        $dp = $order->total_price * 0.3;
        $newTotalPrice = $order->total_price - $dp;

        $finish = Order::whereId($id)->update([
            'order_status' =>
                'Pesanan telah selesai, silahkan lakukan pelunasan sebesar Rp.'
                . number_format($newTotalPrice, 2),
        ]);
        if($finish){
            return back()->with('success','Pesan pelunasan telah berasil disampaikan');
        }else{
            return back()->with('error','Sesuatu terjadi, kesalahan pada server!');
        }
    }

    public function accRepayment($id){
        $acc = Order::whereId($id)->update([
            'order_status' => 'Bouquet akan segera dikirim!.'
        ]);
        if($acc){
            return back()->with('success','Repayment telah berhasil di acc');
        }else{
            return back()->with('error','Sesuatu terjadi, kesalahan pada server!');
        }
    }
    public function cancelRepayment($id){
        $order = Order::find($id);
        if (!$order) {
            return back()->with('error','Order tidak ditemukan');
        }
        if (!empty($order->image)) {
            Storage::delete('storage/' . $order->image);
        }
        $dp = $order->total_price * 0.3;
        $newTotalPrice = $order->total_price - $dp;
        $cancel = $order->update([
            'order_status' => 'Pelunasan tidak valid, silakan upload ulang pelunasan sebesar Rp.'. $newTotalPrice .'!.',
            'repayment_image' => null,
        ]);
        if ($cancel) {
            return back()->with('success','Repayment telah berhasil di cancel');
        } else {
            return back()->with('error','Sesuatu terjadi, kesalahan pada server!');
        }
    }


    public function finish($id){
        $acc = Order::whereId($id)->update([
            'order_status' => 'Pesanan telah selesai.'
        ]);
        if($acc){
            return back()->with('success','Pesanan telah berhasil diselesaikan');
        }else{
            return back()->with('error','Sesuatu terjadi, kesalahan pada server!');
        }
    }
}
