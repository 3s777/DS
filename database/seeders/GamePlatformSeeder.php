<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatform;
use Illuminate\Database\Seeder;
use Services\GamesDbApi\GamesDbApiContract;

class GamePlatformSeeder extends Seeder
{
    public function run(GamesDbApiContract $gamesApi): void
    {
        GamePlatform::factory(10)
            ->recycle(User::factory()->create())
            ->create();

        //        $platforms = $gamesApi->getPlatforms();
        //
        //        foreach ($platforms as $platform) {
        //            if($platform['platforms'] > 0) {
        //                foreach ($platform['platforms'] as $child) {
        //                    GamePlatform::firstOrCreate([
        //                        'name' => $child['name'],
        //                        'platform_manufacturer_id' => 1,
        //                        'platform_type_id' => rand(0, 2)
        //                    ]);
        //                }
        //            }
        //        }
    }
}
