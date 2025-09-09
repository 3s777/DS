<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Models\Media;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Media::factory(500000)->create();
    }
}
