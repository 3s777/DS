<?php

namespace Database\Seeders;

use App\Models\Language;
use Domain\Auth\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $language = Language::query()->first();
        User::factory(10)->for($language)->create();
        User::create([
            'name' => 'qqqqq',
            'email' => 'qqq@qq.qq',
            'password' => bcrypt('123456789q'),
            'email_verified_at' => now(),
            'language_id' => 2
        ]);
    }
}
