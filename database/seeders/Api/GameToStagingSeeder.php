<?php

namespace Database\Seeders\Api;

use App\Models\ApiStagingData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GameToStagingSeeder extends BaseApiSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $page): void
    {
            $response = Http::get($this->host . "/games?key=$this->key&platforms=16&page=$page");

            foreach ($response->json('results') as $game) {

                if (!ApiStagingData::where('data_id', $game['id'])
                    ->where('data_type', 'game')
                    ->exists())
                {
                    $response = Http::get($this->host . '/games/' . $game['id'] . '?key='.$this->key);

                    $currentGame = $response->json();
                    ApiStagingData::query()->firstOrCreate([
                        'data' => $currentGame,
                        'data_id' => $game['id'],
                        'data_type' => 'game',
                        'source' => 'game_api_1'
                    ]);
                }
            }

            sleep(2);

    }
}
