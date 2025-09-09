<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Illuminate\Database\Seeder;
use Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->first();
        Image::factory(10)->for($user)->create();
    }
}
