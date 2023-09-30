<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToppingRequest;
use App\Services\ToppingService;

class ToppingController extends Controller
{
    private $toppingsService;
    public function __construct(ToppingService $toppingsService)
    {
        $this->toppingsService = $toppingsService;
    }
    public function index()
    {
        $toppings = $this->toppingsService->getAllToppings();
        return view('dashboard.topping.index', compact('toppings'));
    }
    public function create()
    {
        return view('dashboard.topping.create');
    }
    public function store(ToppingRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('topping-images', 'public');
            $data['image'] = $imagePath;
        }
        $this->toppingsService->createTopping($data);
        return redirect(route('index-topping'))->with('success', 'Topping berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $topping = $this->toppingsService->getToppingById($id);
        return view('dashboard.topping.edit', compact('topping'));
    }
    public function update(ToppingRequest $request, $id)
    {
        $topping = $this->toppingsService->getToppingById($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($topping->image) {
                $this->toppingsService->deleteImage($topping->image);
            }
            $imagePath = $request->file('image')->store('topping-images', 'public');
            $data['image'] = $imagePath;
        }
        $this->toppingsService->updateTopping($topping, $data);
        return redirect(route('index-topping'))->with('success', 'Topping berhasil diupdate.');
    }
    public function destroy($id)
    {
        $topping = $this->toppingsService->getToppingById($id);
        if ($topping->image) {
            $this->toppingsService->deleteImage($topping->image);
        }
        $this->toppingsService->deleteTopping($topping);
        return redirect(route('index-topping'))->with('success', 'Topping berhasil dihapus.');
    }
}

