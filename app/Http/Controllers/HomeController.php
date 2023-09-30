<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\BouquetCustom;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $bouquets = Bouquet::all();
        $toppings = Topping::all();
        return view('pages.index',compact('bouquets','toppings'));
    }
    public function indexNotifikasi(){
        $notifications = Notification::all();
        return view('pages.notification.index',compact('notifications'));
    }
    public function indexOrder(){
        $orders = Order::with(['user','bouquet','bouquetCustom'])->where('owner_id',auth()->user()->id)->get();
        $toppings = Topping::all();
        return view('pages.order.index',compact('orders','toppings'));
    }
    public function indexBouquetCustom(){
        $bouquetCustom = BouquetCustom::where('creator_id',auth()->user()->id)->get();
        $toppings = Topping::all();
        return view('pages.bouquet-custom.index',compact('bouquetCustom','toppings'));
    }

    public function createOrder(Request $request){
        $bouquet = Bouquet::whereId($request->input('id'))->first();
        $toppings = Topping::all();
        return view('pages.order.create',compact('bouquet','toppings'));
    }

    public function createOrderBouquetCustom(Request $request){
        $bouquet = BouquetCustom::whereId($request->input('id'))->first();
        return view('pages.bouquet-custom.checkout',compact('bouquet'));
    }

    public function createBouquetCustom(){
        $toppings = Topping::all();
        return view('pages.bouquet-custom.create',compact('toppings'));
    }
    public function payDP(Request $request){
        $id = Order::whereId($request->input('id'))->first()->id;
        return view('pages.order.dp',compact('id'));
    }
    public function payRepayment(Request $request){
        $id = Order::whereId($request->input('id'))->first()->id;
        return view('pages.order.repayment',compact('id'));
    }
    public function storeDP(Request $request){
        $request->validate([
            'dp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('dp')) {
            $image = $request->file('dp');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('dp-images', $imageName, 'public');
            $update = Order::whereId($request->input('id'))->update([
                'dp_image' => $imagePath,
                'order_status' => 'DP telah diupload, menunggu konfirmasi dari admin.'
            ]);
            if($update) {
                return redirect()->to(route('index-order'))->with('success', 'Image uploaded successfully.');
            }else {
                return redirect()->to(route('index-order'))->with('error','Sesuatu terjadi, kesalahan pada serve');
            }
        }
        return redirect()->to(route('index-order'))->with('error', 'Gagal mengupload gambar.');
    }
    public function storeRepayment(Request $request){
        $request->validate([
            'repayment' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('repayment')) {
            $image = $request->file('repayment');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('repayment-images', $imageName, 'public');
            $update = Order::whereId($request->input('id'))->update([
                'repayment_image' => $imagePath,
                'order_status' => 'Pelunasan telah diupload, menunggu konfirmasi dari admin.'
            ]);
            if($update) {
                return redirect()->to(route('index-order'))->with('success', 'Image uploaded successfully.');
            }else {
                return redirect()->to(route('index-order'))->with('error','Sesuatu terjadi, kesalahan pada serve');
            }
        }
        return redirect()->to(route('index-order'))->with('error', 'Gagal mengupload gambar.');
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
