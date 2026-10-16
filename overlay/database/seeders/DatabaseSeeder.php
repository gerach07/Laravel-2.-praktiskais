<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Demo lietotājs',
            'email' => 'demo@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            GenreSeeder::class,
            BookSeeder::class,
        ]);
    }
}
