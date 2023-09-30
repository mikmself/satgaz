<?php
namespace App\Services;

use App\Models\Topping;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ToppingService
{
    public function getAllToppings()
    {
        return Topping::all();
    }

    public function createTopping($data)
    {
        $data['id'] = Str::uuid();
        return Topping::create($data);
    }

    public function getToppingById($id)
    {
        return Topping::find($id);
    }

    public function updateTopping($topping, $data)
    {
        $topping->update($data);
        return $topping;
    }

    public function deleteTopping($topping)
    {
        $topping->delete();
    }

    public function deleteImage($imagePath)
    {
        Storage::disk('public')->delete($imagePath);
    }
}
