<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Condition;
use Database\Factories\GamePublisherFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
//            GameGenreSeeder::class,
//            ConditionSeeder::class,
//            GamePlatformSeeder::class,
//            GamePlatformManufacturerSeeder::class,
//            GamePlatformTypeSeeder::class,
            GameSeeder::class
        ]);
    }
}
