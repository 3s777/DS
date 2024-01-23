<?php

namespace Database\Seeders;

use Domain\Auth\Models\UserSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSetting::create([
            'name' => 'Язык',
        ]);

        UserSetting::create([
            'name' => 'Цвет темы',
        ]);
    }
}
