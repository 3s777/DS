<?php

namespace Database\Seeders;

use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePlatformManufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Services\GamesDbApi\GamesDbApiContract;

class GamePlatformManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(GamesDbApiContract $gamesApi): void
    {
        $manufacturers = $gamesApi->getPlatforms();

        foreach ($manufacturers as $manufacturer) {
            GamePlatformManufacturer::firstOrCreate([
                'name' => $manufacturer['name'],
            ]);
        }
    }
}
