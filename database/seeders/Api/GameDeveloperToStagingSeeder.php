<?php

namespace Database\Seeders\Api;

use App\Models\ApiStagingData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GameDeveloperToStagingSeeder extends BaseApiSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $page): void
    {
            $response = Http::get($this->host . "/developers?key=$this->key&page=$page");

            foreach ($response->json('results') as $developer) {

                if (!ApiStagingData::where('data_id', $developer['id'])
                    ->where('data_type', 'game_developer')
                    ->exists())
                {
                    $response = Http::get($this->host . '/developers/' . $developer['id'] . '?key='.$this->key);

                    $currentDeveloper = $response->json();
                    ApiStagingData::query()->firstOrCreate([
                        'data' => $currentDeveloper,
                        'data_id' => $developer['id'],
                        'data_type' => 'game_developer'
                    ]);
                }
            }

            sleep(2);

    }

    public function runById(int $id): void
    {
        if (!ApiStagingData::query()->where('data_id', $id)
            ->where('data_type', 'game_developer')
            ->exists())
        {
            $response = Http::get($this->host . '/developers/' . $id . '?key='.$this->key);

            $currentDeveloper = $response->json();
            ApiStagingData::query()->firstOrCreate([
                'data' => $currentDeveloper,
                'data_id' => $id,
                'data_type' => 'game_developer',
                'source' => 'game_api_1'
            ]);
        }
    }
}
