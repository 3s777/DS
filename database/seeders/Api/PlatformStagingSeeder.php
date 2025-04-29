<?php

namespace Database\Seeders\Api;

use App\Models\ApiStagingData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PlatformStagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $page): void
    {
        $host = config('api.games_host');
        $key = config('api.games_key');

            $response = Http::get($host . "/platforms?key=$key&page=$page");

            foreach ($response->json('results') as $platform) {

                if (!ApiStagingData::where('data_id', $platform['id'])
                    ->where('data_type', 'platform')
                    ->exists())
                {
                    $response = Http::get($host . '/platforms/' . $platform['id'] . '?key='.$key);

                    $currentPlatform = $response->json();
                    ApiStagingData::create([
                        'data' => $currentPlatform,
                        'data_id' => $platform['id'],
                        'data_type' => 'platform'
                    ]);
                }
            }

            sleep(2);
    }
}
