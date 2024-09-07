<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
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
        GameGenre::factory(10)
            ->create();
//        $genres = $gamesApi->getGenres();
//
//        foreach ($genres as $genre) {
//            GameGenre::firstOrCreate([
//                'name' => $genre['name'],
//            ]);
//        }
    }
}
