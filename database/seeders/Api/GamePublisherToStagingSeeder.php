<?php

namespace Database\Seeders\Api;

use Illuminate\Support\Facades\Http;
use Models\ApiStagingData;

class GamePublisherToStagingSeeder extends BaseApiSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $page): void
    {
        $response = Http::get($this->host . "/publishers?key=$this->key&page=$page");

        foreach ($response->json('results') as $publisher) {

            if (!ApiStagingData::where('data_id', $publisher['id'])
                ->where('data_type', 'game_publisher')
                ->exists()) {
                $response = Http::get($this->host . '/publishers/' . $publisher['id'] . '?key='.$this->key);

                $currentPublisher = $response->json();
                ApiStagingData::query()->firstOrCreate([
                    'data' => $currentPublisher,
                    'data_id' => $publisher['id'],
                    'data_type' => 'game_publisher',
                    'source' => 'game_api_1'
                ]);
            }
        }

        sleep(2);
    }

    public function runById(int $id): void
    {
        if (!ApiStagingData::query()->where('data_id', $id)
            ->where('data_type', 'game_publisher')
            ->exists()) {
            $response = Http::get($this->host . '/publishers/' . $id . '?key='.$this->key);

            $currentPublisher = $response->json();
            ApiStagingData::query()->firstOrCreate([
                'data' => $currentPublisher,
                'data_id' => $id,
                'data_type' => 'game_publisher',
                'source' => 'game_api_1'
            ]);
        }
    }
}
