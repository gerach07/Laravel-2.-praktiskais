<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['Fantāzija', 'Zinātniskā fantastika', 'Detektīvs', 'Romāns', 'Vēsture', 'Zinātne', 'Programmēšana'];

        foreach ($genres as $name) {
            Genre::create(['name' => $name]);
        }
    }
}
