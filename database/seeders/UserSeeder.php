<?php

namespace Database\Seeders;

use App\Models\Language;
use Domain\Auth\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::create([
            'name' => 'qqqqq',
            'first_name' => 'Test Name',
            'slug' => 'qqqqq',
            'email' => 'qqq@qq.qq',
            'password' => bcrypt('123456789q'),
            'email_verified_at' => now(),
            'language' => 'en'
        ]);
    }
}
