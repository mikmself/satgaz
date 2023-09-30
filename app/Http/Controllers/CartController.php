<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        return view('pages.cart.index', compact('carts'));
    }
    public function addToCart($bouquet_id){
        $created = Cart::create([
            'id' => Str::uuid(),
            'bouquet_id' => $bouquet_id,
            'total_order' => 1
        ]);
        if($created){
            return back()->with('success','Berhasil ditambahkan ke cart');
        }
        return back()->with('error','Gagal menambahkan ke cart, kesalahan pada server');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('index-cart')->with('success', 'Item dari cart berhasil dihapus.');
    }
}
