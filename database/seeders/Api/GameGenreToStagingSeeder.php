<?php

namespace Database\Seeders\Api;

use App\Models\ApiStagingData;
use Illuminate\Support\Facades\Http;

class GameGenreToStagingSeeder extends BaseApiSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get($this->host . "/genres?key=$this->key");

        foreach ($response->json('results') as $genre) {

            if (!ApiStagingData::where('data_id', $genre['id'])
                ->where('data_type', 'genre')
                ->exists()) {
                $response = Http::get($this->host . '/genres/' . $genre['id'] . '?key='.$this->key);

                $currentPlatform = $response->json();
                ApiStagingData::create([
                    'data' => $currentPlatform,
                    'data_id' => $genre['id'],
                    'data_type' => 'genre',
                    'source' => 'game_api_1'
                ]);
            }
        }

        sleep(2);
    }
}
