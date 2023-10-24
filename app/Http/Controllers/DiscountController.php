<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('dashboard.discount.index', compact('discounts'));
    }

    public function show($id){
        $discount = Discount::where('id',$id)->first();
        if (isset($discount)){
            return view('dashboard.discount.show', compact('discount'));
        }else{
            return back()->with('error', 'Data discount tidak ditemukan');
        }
    }
    public function create()
    {
        $users = User::where('level','admin')->orWhere('level','superadmin')->get();
        return view('dashboard.discount.create',compact('users'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required|uuid|exists:users,id',
            'name' => 'required',
            'code' => 'required|unique:discounts,code',
            'discount' => 'required|numeric',
            'limit' => 'required|numeric',
            'expired' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('errors',$validator->errors());
        } else {
            $id = Str::uuid();
            $data = $request->only([
                'admin_id',
                'name',
                'code',
                'discount',
                'limit',
                'expired'
            ]);
            $data['id'] = $id;
            $dataCreated = Discount::create($data);
            if($dataCreated){
                return redirect(route('index-discount'))->with('success', 'Discount berhasil dibuat.');
            }else{
                return back()->with('error','Discount gagal dibuat');
            }
        }
    }

    public function edit($id)
    {
        $discount = Discount::whereId($id)->first();
        $users = User::where('level','admin')->orWhere('level','superadmin')->get();
        return view('dashboard.discount.edit', compact('discount','users'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required|uuid|exists:users,id',
            'name' => 'required',
            'code' => 'required|unique:discounts,code,' . $id,
            'discount' => 'required|numeric',
            'limit' => 'required|numeric',
            'expired' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('errors',$validator->errors());
        } else {
            $discount = Discount::find($id);
            if (!$discount) {
                return back()->with('error','Data discount tidak ditemukan');
            } else {
                $data = $request->only([
                    'admin_id',
                    'name',
                    'code',
                    'discount',
                    'limit',
                    'expired'
                ]);
                $dataUpdated = $discount->update($data);
                if($dataUpdated){
                    return redirect(route('index-discount'))->with('success', 'Discount berhasil diedit.');
                }else{
                    return back()->with('error','Discount gagal diedit');
                }
            }
        }
    }
    public function destroy($id)
    {
        $discount = Discount::find($id);
        if (!$discount) {
            return back()->with('error','Data discount tidak ditemukan');
        }
        $discount->delete();
        return redirect(route('index-discount'))->with('success', 'Discount berhasil dihapus.');
    }
}
