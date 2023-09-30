<?php

namespace App\Services;

use App\Models\Bouquet;
use Illuminate\Support\Str;

class BouquetService
{
    public function getAllBouquets()
    {
        return Bouquet::all();
    }

    public function createBouquet($data)
    {
        $data['id'] = Str::uuid();
        return Bouquet::create($data);
    }

    public function getBouquetById($id)
    {
        return Bouquet::findOrFail($id);
    }

    public function updateBouquet($bouquet, $data)
    {
        $bouquet->update($data);
        return $bouquet;
    }

    public function deleteBouquet($bouquet)
    {
        $bouquet->delete();
    }
}
