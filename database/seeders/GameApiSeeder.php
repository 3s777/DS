<?php

namespace Database\Seeders;

use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Seeder;
use Services\GamesDbApi\GamesDbApiContract;

class GameApiSeeder extends Seeder
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
                $currentPublisher = GamePublisher::firstOrCreate([
                    'name' => $publisher['name'],
                    'user_id' => '11'
                ]);
                $currentGame->publishers()->attach($currentPublisher->id);
            }

            foreach ($game->developers as $developer) {
                $currentDeveloper = GameDeveloper::firstOrCreate([
                    'name' => $developer['name'],
                    'slug' => $developer['name'],
                    'user_id' => '11'
                ]);
                $currentGame->developers()->attach($currentDeveloper->id);
            }

            foreach ($game->genres as $genre) {
                $currentGenre = GameGenre::firstOrCreate([
                    'name' => $genre['name'],
                ]);
                $currentGame->genres()->attach($currentGenre->id);
            }

            foreach ($game->platforms as $platform) {
                $currentPlatform = GamePlatform::firstOrCreate([
                    'name' => $platform['platform']['name'],
                ]);
                $currentGame->platforms()->attach($currentPlatform->id);
            }
        }
    }
}
