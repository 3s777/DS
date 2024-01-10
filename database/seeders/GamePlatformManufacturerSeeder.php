<?php

namespace Database\Seeders;

use Domain\Game\Models\Platform;
use Domain\Game\Models\PlatformManufacturer;
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
            PlatformManufacturer::firstOrCreate([
                'name' => $manufacturer['name'],
            ]);
        }
    }
}
