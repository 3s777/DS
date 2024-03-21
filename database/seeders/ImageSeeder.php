<?php

namespace Database\Seeders;

use App\Models\Image;
use Domain\Auth\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
