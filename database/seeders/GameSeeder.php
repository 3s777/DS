<?php

namespace Database\Seeders;

use Domain\Game\DTOs\ApiGamesDTO;
use Domain\Game\Models\Developer;
use Domain\Game\Models\Game;
use Domain\Game\Models\Genre;
use Domain\Game\Models\Platform;
use Domain\Game\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Services\GamesDbApi\GamesDbApiContract;
use Spatie\FlareClient\Api;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(GamesDbApiContract $gamesApi): void
    {
        $games = $gamesApi->getGames();

        foreach ($games as $game) {

            $currentGame = Game::createOrFirst([
                'name' => $game->name,
                'released_at' => $game->released,
                'description' => $game->description
            ]);

            if(empty($currentGame->alternative_names)) {
                $currentGame->alternative_names = $game->alternative_names;
                $currentGame->save();
            }

            foreach ($game->publishers as $publisher) {
                $currentPublisher = Publisher::firstOrCreate([
                    'name' => $publisher['name'],
                ]);
                $currentGame->publishers()->attach($currentPublisher->id);
            }

            foreach ($game->developers as $developer) {
                $currentDeveloper = Developer::firstOrCreate([
                    'name' => $developer['name'],
                ]);
                $currentGame->developers()->attach($currentDeveloper->id);
            }

            foreach ($game->genres as $genre) {
                $currentGenre = Genre::firstOrCreate([
                    'name' => $genre['name'],
                ]);
                $currentGame->genres()->attach($currentGenre->id);
            }

            foreach ($game->platforms as $platform) {
                    $currentPlatform = Platform::firstOrCreate([
                        'name' => $platform['platform']['name'],
                    ]);
                    $currentGame->platforms()->attach($currentPlatform->id);
            }
        }
    }
}
