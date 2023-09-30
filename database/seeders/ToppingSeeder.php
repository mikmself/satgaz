<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\Topping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping1'],
            'name' => 'Topping Bouquet 1',
            'description' => 'Ini adalah topping dari bouquet satgaz 1',
            'price' => 5000,
            'image' => 'topping-images/topping1.jpg'
        ]);
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping2'],
            'name' => 'Topping Bouquet 2',
            'description' => 'Ini adalah topping dari bouquet satgaz 2',
            'price' => 5000,
            'image' => 'topping-images/topping2.jpg'
        ]);
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping3'],
            'name' => 'Topping Bouquet 3',
            'description' => 'Ini adalah topping dari bouquet satgaz 3',
            'price' => 5000,
            'image' => 'topping-images/topping3.jpg'
        ]);
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping4'],
            'name' => 'Topping Bouquet 4',
            'description' => 'Ini adalah topping dari bouquet satgaz 4',
            'price' => 5000,
            'image' => 'topping-images/topping4.jpg'
        ]);
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping5'],
            'name' => 'Topping Bouquet 5',
            'description' => 'Ini adalah topping dari bouquet satgaz 5',
            'price' => 5000,
            'image' => 'topping-images/topping5.jpg'
        ]);
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping6'],
            'name' => 'Topping Bouquet 6',
            'description' => 'Ini adalah topping dari bouquet satgaz 6',
            'price' => 5000,
            'image' => 'topping-images/topping6.jpg'
        ]);
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping7'],
            'name' => 'Topping Bouquet 7',
            'description' => 'Ini adalah topping dari bouquet satgaz 7',
            'price' => 5000,
            'image' => 'topping-images/topping7.jpg'
        ]);
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping8'],
            'name' => 'Topping Bouquet 8',
            'description' => 'Ini adalah topping dari bouquet satgaz 8',
            'price' => 5000,
            'image' => 'topping-images/topping8.jpg'
        ]);
        Topping::create([
            'id' => SeederHelper::getTopingIds()['topping9'],
            'name' => 'Topping Bouquet 9',
            'description' => 'Ini adalah topping dari bouquet satgaz 9',
            'price' => 5000,
            'image' => 'topping-images/topping9.jpg'
        ]);
    }
}
