<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::create([
            'id' => Str::uuid(),
            'title' => 'Promo Akhir Tahun!',
            'content' => 'Promo akhir tahun khusus bagi anda pelanggan setia Bouquet Satgaz!. Dapatkan diskon spesial sebesar 30% untuk seluruh jenis bouquet yang anda beli!.'
        ]);
        Notification::create([
            'id' => Str::uuid(),
            'title' => 'Varian Bouquet Baru!',
            'content' => 'Kabar gembira bagi anda!. Bouquet Satgaz telah melaunching bouquet baru yang kami beri nama "Bouquet Bulan Purnama" dengan bentuk yang unik yang menarik!. Dapatkan bouquet ini dengan harga special launching!.'
        ]);
    }
}
