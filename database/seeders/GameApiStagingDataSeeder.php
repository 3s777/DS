<?php

namespace Database\Seeders;

use App\Models\ApiStagingData;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Services\GamesDbApi\GamesDbApiContract;

class GameApiStagingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $host = env('GAME_API_HOST');
        $key = env('GAME_API_KEY');

        for ($i = 2; $i <= 5; $i++) {
            $response = Http::get($host . "/games?key=$key&platforms=16&page=$i");

            foreach ($response->json('results') as $game) {

                $response = Http::get($host . '/games/' . $game['id'] . '?key='.$key);

                $currentGame = $response->json();
                ApiStagingData::create([
                    'data' => $currentGame,
                    'data_id' => $game['id'],
                    'data_type' => 'game'
                ]);
            }
        }

    }
}
