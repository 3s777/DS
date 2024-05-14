<?php

namespace Database\Seeders;

use Domain\Game\Models\GamePlatformType;
use Illuminate\Database\Seeder;

class GamePlatformTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Стационарная', 'Портативная', 'Универсальная'];

        foreach ($types as $type) {
            GamePlatformType::firstOrCreate([
                'name' => $type,
            ]);
        }
    }
}
