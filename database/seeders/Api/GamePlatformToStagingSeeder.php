<?php

namespace Database\Seeders\Api;

use Illuminate\Support\Facades\Http;
use Models\ApiStagingData;

class GamePlatformToStagingSeeder extends BaseApiSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $page): void
    {
        $response = Http::get($this->host . "/platforms?key=$this->key&page=$page");

        foreach ($response->json('results') as $platform) {

            if (!ApiStagingData::where('data_id', $platform['id'])
                ->where('data_type', 'platform')
                ->exists()) {
                $response = Http::get($this->host . '/platforms/' . $platform['id'] . '?key='.$this->key);

                $currentPlatform = $response->json();
                ApiStagingData::create([
                    'data' => $currentPlatform,
                    'data_id' => $platform['id'],
                    'data_type' => 'platform',
                    'source' => 'game_api_1'
                ]);
            }
        }

        sleep(2);
    }
}
