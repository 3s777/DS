<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Media;
use Domain\Auth\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
