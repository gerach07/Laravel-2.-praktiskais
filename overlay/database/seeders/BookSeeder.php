<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        // [nosaukums, autors, žanrs, lappuses, gads, izlasīta]
        $books = [
            ['Hobits', 'J. R. R. Tolkīns', 'Fantāzija', 310, 1937, true],
            ['Gredzenu pavēlnieks', 'J. R. R. Tolkīns', 'Fantāzija', 1200, 1954, false],
            ['Dune', 'Frenks Herberts', 'Zinātniskā fantastika', 688, 1965, true],
            ['Fonds', 'Aizeks Azimovs', 'Zinātniskā fantastika', 255, 1951, false],
            ['Marsietis', 'Endijs Vīrs', 'Zinātniskā fantastika', 369, 2011, true],
            ['Slepkavība Orient ekspresī', 'Agata Kristi', 'Detektīvs', 256, 1934, false],
            ['Šerloka Holmsa piedzīvojumi', 'Artūrs Konans Doils', 'Detektīvs', 307, 1892, true],
            ['Dzīvīte', 'Rūdolfs Blaumanis', 'Romāns', 120, 1900, false],
            ['Īsa pasaules vēsture', 'Ernsts Gombrihs', 'Vēsture', 320, 1936, false],
            ['Īsa laika vēsture', 'Stīvens Hokings', 'Zinātne', 212, 1988, true],
            ['Clean Code', 'Roberts Mārtins', 'Programmēšana', 464, 2008, false],
            ['Laravel: Up & Running', 'Metjū Staufers', 'Programmēšana', 550, 2016, false],
        ];

        foreach ($books as $b) {
            Book::create([
                'user_id' => $user->id,
                'genre_id' => Genre::where('name', $b[2])->first()->id,
                'title' => $b[0],
                'author' => $b[1],
                'pages' => $b[3],
                'year' => $b[4],
                'is_read' => $b[5],
                'description' => null,
            ]);
        }
    }
}
