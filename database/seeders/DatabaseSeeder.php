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
            RolesAndPermissionsSeeder::class,
//            GameSeeder::class,
            GameMediaSeeder::class,
            CollectibleSeeder::class
//            GameApiSeeder::class,
//            GameDeveloperSeeder::class,
//            GamePublisherSeeder::class,
//            GameGenreSeeder::class,
//            GamePlatformManufacturerSeeder::class,
//            GamePlatformSeeder::class,
//            GameGenreSeeder::class,
//            ConditionSeeder::class,
//            GamePlatformSeeder::class,
//            GamePlatformTypeSeeder::class,
//            GameSeeder::class,
//            ImageSeeder::class,
//            MediaSeeder::class
        ]);
    }
}
