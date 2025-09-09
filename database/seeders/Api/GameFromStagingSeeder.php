<?php

namespace Database\Seeders\Api;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Seeder;
use Models\ApiStagingData;

class GameFromStagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('name', 'qqqqq')->first();

        $games = ApiStagingData::query()->where('data_type', 'game')->get();

        foreach ($games as $game) {

            if (Game::where('name', $game['data']['name'])->exists()) {
                continue;
            }

            $currentGame = Game::create(
                [
                    'name' => $game['data']['name'],
                ],
                [
                    'released_at' => $game['data']['released_at'] ?? null,
                    'description' => ['en' => $game['data']['description'] ?? null],
                    'alternative_names' => $game['data']['alternative_names'] ?? null,
                    'user_id' => $user->id,
                ]
            );

            if (isset($game['data']['publishers'])) {
                foreach ($game['data']['publishers'] as $publisher) {
                    $stagingPublisher = ApiStagingData::query()
                        ->where('data_type', 'game_publisher')
                        ->where('data_id', $publisher['id'])
                        ->first();

                    $currentPublisher = GamePublisher::firstOrCreate(
                        [
                        'name' => $stagingPublisher['data']['name'],
                        ],
                        [
                            'user_id' => $user->id,
                            'description' => ['en' => $stagingPublisher['data']['description'] ?? null],
                        ]
                    );

                    $currentGame->publishers()->attach($currentPublisher->id);
                }
            }

            if (isset($game['data']['developers'])) {
                foreach ($game['data']['developers'] as $developer) {
                    $stagingDeveloper = ApiStagingData::query()
                        ->where('data_type', 'game_developer')
                        ->where('data_id', $developer['id'])
                        ->first();

                    $currentDeveloper = GameDeveloper::firstOrCreate(
                        [
                            'name' => $stagingDeveloper['data']['name'],
                        ],
                        [
                            'user_id' => $user->id,
                            'description' => ['en' => $stagingDeveloper['data']['description'] ?? null],
                        ]
                    );

                    $currentGame->developers()->attach($currentDeveloper->id);
                }
            }

            if (isset($game['data']['genres'])) {
                foreach ($game['data']['genres'] as $genre) {
                    $stagingGenre = ApiStagingData::query()
                        ->where('data_type', 'game_genre')
                        ->where('data_id', $genre['id'])
                        ->first();

                    $currentGenre = GameGenre::firstOrCreate(
                        [
//                                'name' => ['en' => $stagingGenre['data']['name']],
                            'name' => $stagingGenre['data']['name'],
                        ],
                        [
                            'user_id' => $user->id,
                            'description' => ['en' => $stagingGenre['data']['description'] ?? null],
                        ]
                    );

                    $currentGame->genres()->attach($currentGenre->id);
                }
            }

            if (isset($game['data']['platforms'])) {
                foreach ($game['data']['platforms'] as $platform) {
                    $stagingPlatform = ApiStagingData::query()
                        ->where('data_type', 'game_platform')
                        ->where('data_id', $platform['platform']['id'])
                        ->first();

                    $currentPlatform = GamePlatform::firstOrCreate(
                        [
                            'name' => $stagingPlatform['data']['name'],
                        ],
                        [
                            'user_id' => $user->id,
                            'description' => ['en' => $stagingPlatform['data']['description'] ?? null],
                        ]
                    );

                    $currentGame->platforms()->attach($currentPlatform->id);
                }
            }
        }
    }
}
