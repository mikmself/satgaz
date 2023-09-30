<?php

namespace App\Http\Controllers;

use App\Http\Requests\BouquetRequest;
use App\Services\BouquetService;
use Illuminate\Support\Facades\Storage;

class BouquetController extends Controller
{
    private $bouquetService;
    public function __construct(BouquetService $bouquetService)
    {
        $this->bouquetService = $bouquetService;
    }
    public function index()
    {
        $bouquets = $this->bouquetService->getAllBouquets();
        return view('dashboard.bouquet.index', compact('bouquets'));
    }
    public function create()
    {
        return view('dashboard.bouquet.create');
    }
    public function store(BouquetRequest $request)
    {
        $data = $request->validated();
        $imagePath = $request->file('image')->store('bouquet-images', 'public');
        $data['image'] = $imagePath;
        $this->bouquetService->createBouquet($data);
        return redirect(route('index-bouquet'))->with('success', 'Bouquet berhasil dibuat.');
    }
    public function edit($id)
    {
        $bouquet = $this->bouquetService->getBouquetById($id);
        return view('dashboard.bouquet.edit', compact('bouquet'));
    }
    public function update(BouquetRequest $request, $id)
    {
        $bouquet = $this->bouquetService->getBouquetById($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($bouquet->image) {
                Storage::disk('public')->delete($bouquet->image);
            }
            $imagePath = $request->file('image')->store('bouquet-images', 'public');
            $data['image'] = $imagePath;
        }
        $this->bouquetService->updateBouquet($bouquet, $data);
        return redirect(route('index-bouquet'))->with('success', 'Bouquet berhasil diupdate.');
    }


    public function destroy($id)
    {
        $bouquet = $this->bouquetService->getBouquetById($id);
        $this->bouquetService->deleteBouquet($bouquet);
        return redirect(route('index-bouquet'))->with('success', 'Bouquet berhasil dihapus.');
    }
}

