<?php

namespace App\Http\Controllers;
use App\Models\Bouquet;
use App\Models\BouquetCustom;
use App\Models\Order;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BouquetCustomController extends Controller
{
    public function index(){
        $bouquetCustom = BouquetCustom::all();
        $toppings = Topping::all();
        return view('dashboard.bouquet-custom.index',compact('bouquetCustom','toppings'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'desc' => 'required',
            'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'toppings' => 'required|array',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $price = 0;
        $toppings_data = [];
        if($request->input('toppings') !== null){
            foreach ($request->input('toppings') as $topping){
                if(isset($topping['status'])){
                    $data_toping = Topping::where('id',$topping['id'])->first();
                    $price += $data_toping->price * $topping['total'];
                    $store_topping = [
                        'id' => $topping['id'],
                        'total' => $topping['total']
                    ];
                    array_push($toppings_data,$store_topping);
                }
            }
        }
        $imagePath = $request->file('image')->store('bouquet-custom-images', 'public');
        $created = BouquetCustom::create([
            'id' => Str::uuid(),
            'creator_id' => auth()->user()->id,
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'price' => $price,
            'toppings' => json_encode($toppings_data),
            'image' => $imagePath
        ]);
        if($created){
            return redirect()
                ->to(route('index-bouquet-custom'))
                ->with('success','Bouquet telah berhasil dibuat.');
        }else{
            return back()->with('error','Bouquet gagal dibuat, kesalahan pada server!');
        }
    }
    public function destroy($id)
    {
        $bouquetCustom = BouquetCustom::find($id);
        if (!$bouquetCustom) {
            return back()->with('error', 'BouquetCustom tidak ditemukan');
        }
        $bouquetCustom->delete();
        return back()->with('success', 'BouquetCustom berhasil dihapus');
    }
}

