<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Seeder;

class GamePublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GamePublisher::factory(10)
            ->create();
    }
}
