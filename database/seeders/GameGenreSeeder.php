<?php

namespace Database\Seeders;

use Domain\Game\Models\GameGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Services\GamesDbApi\GamesApi;
use Services\GamesDbApi\GamesDbApiContract;

class GameGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(GamesDbApiContract $gamesApi): void
    {
        $genres = $gamesApi->getGenres();

        foreach ($genres as $genre) {
            GameGenre::firstOrCreate([
                'name' => $genre['name'],
            ]);
        }
    }
}
