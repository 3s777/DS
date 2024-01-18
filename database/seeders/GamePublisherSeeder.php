<?php

namespace Database\Seeders;

use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamePublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GamePublisher::factory(3)->create();
    }
}
