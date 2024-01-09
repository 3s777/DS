<?php

namespace Database\Seeders;

use Domain\Game\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GameGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get(env('GAME_API_HOST')."/genres?key=".env('GAME_API_HOST'));

        $genres = $response->json('results');
        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre['name'],
            ]);
        }
    }
}
