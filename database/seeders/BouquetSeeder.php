<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\Bouquet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BouquetSeeder extends Seeder
{
    public function run(): void
    {
        Bouquet::create([
            'id' => SeederHelper::getBouquetIds()['bouquet1'],
            'name' => 'Bouquet Satgaz Type 1',
            'description' => 'Ini adalah contoh bouquet satgaz type 1',
            'price' => '100000',
            'image' => 'bouquet-images/bouquet1.jpg'
        ]);
        Bouquet::create([
            'id' => SeederHelper::getBouquetIds()['bouquet2'],
            'name' => 'Bouquet Satgaz Type 2',
            'description' => 'Ini adalah contoh bouquet satgaz type 2',
            'price' => '70000',
            'image' => 'bouquet-images/bouquet2.jpg'
        ]);
        Bouquet::create([
            'id' => SeederHelper::getBouquetIds()['bouquet3'],
            'name' => 'Bouquet Satgaz Type 3',
            'description' => 'Ini adalah contoh bouquet satgaz type 3',
            'price' => '90000',
            'image' => 'bouquet-images/bouquet3.jpg'
        ]);
        Bouquet::create([
            'id' => SeederHelper::getBouquetIds()['bouquet4'],
            'name' => 'Bouquet Satgaz Type 4',
            'description' => 'Ini adalah contoh bouquet satgaz type 4',
            'price' => '60000',
            'image' => 'bouquet-images/bouquet4.jpg'
        ]);
        Bouquet::create([
            'id' => SeederHelper::getBouquetIds()['bouquet5'],
            'name' => 'Bouquet Satgaz Type 5',
            'description' => 'Ini adalah contoh bouquet satgaz type 5',
            'price' => '150000',
            'image' => 'bouquet-images/bouquet5.jpg'
        ]);
    }
}
