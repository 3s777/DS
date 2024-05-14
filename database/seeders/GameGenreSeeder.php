<?php

namespace Database\Seeders;

use Domain\Game\Models\GameGenre;
use Illuminate\Database\Seeder;
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
