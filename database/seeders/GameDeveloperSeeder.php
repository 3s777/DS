<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Database\Seeder;

class GameDeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GameDeveloper::factory(10)
            ->create();
    }
}
