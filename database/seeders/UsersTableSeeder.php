<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id' => SeederHelper::getUserIds()['superadmin'],
            'name' => 'Muhamd Irga Khoirul Mahfis',
            'email' => 'mikmself@gmail.com',
            'telephone' => '081229473829',
            'level' => 'Superadmin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'id' => SeederHelper::getUserIds()['admin'],
            'name' => 'Admin Demo',
            'email' => 'admin@gmail.com',
            'telephone' => '082983728392',
            'level' => 'admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'id' => SeederHelper::getUserIds()['user'],
            'name' => 'User Demo',
            'email' => 'user@gmail.com',
            'telephone' => '081928736273',
            'level' => 'user',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
