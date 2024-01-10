<?php

namespace Database\Seeders;

use Domain\Game\Models\PlatformType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            PlatformType::firstOrCreate([
                'name' => $type,
            ]);
        }
    }
}
