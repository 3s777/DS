<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            UserSeeder::class,
            GameDeveloperSeeder::class,
//            GameGenreSeeder::class,
//            ConditionSeeder::class,
////            GamePlatformSeeder::class,
////            GamePlatformManufacturerSeeder::class,
////            GamePlatformTypeSeeder::class,
////            GameSeeder::class,
//            ImageSeeder::class,
//            MediaSeeder::class
        ]);
    }
}
