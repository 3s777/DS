<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Seeder;

class TestUserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'qqqqq',
            'first_name' => 'Test Name',
            'slug' => 'qqqqq',
            'email' => 'qqq@qq.qq',
            'password' => bcrypt('123456789q'),
            'email_verified_at' => now(),
            'language' => 'en'
        ]);

        $testUser = User::where('name', 'qqqqq')->first();

        $testUser->assignRole('super_admin');

        Shelf::factory(2)
            ->has(Collectible::factory(5)
                ->for($testUser, 'user'), 'collectibles')
            ->for($testUser, 'user')
            ->create();
    }
}
