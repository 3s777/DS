<?php

namespace Database\Seeders\Api;

use App\Models\ApiStagingData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GameStagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $page): void
    {
        $host = config('api.games_host');
        $key = config('api.games_key');

            $response = Http::get($host . "/games?key=$key&platforms=16&page=$page");

            foreach ($response->json('results') as $game) {

                if (!ApiStagingData::where('data_id', $game['id'])
                    ->where('data_type', 'game')
                    ->exists())
                {
                    $response = Http::get($host . '/games/' . $game['id'] . '?key='.$key);

                    $currentGame = $response->json();
                    ApiStagingData::query()->firstOrCreate([
                        'data' => $currentGame,
                        'data_id' => $game['id'],
                        'data_type' => 'game'
                    ]);
                }
            }

            sleep(2);

    }
}
