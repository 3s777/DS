<?php

namespace Database\Seeders;

use Domain\Auth\Models\UserSetting;
use Domain\Auth\Models\UserSettingValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSettingValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSettingValue::create([
            'user_setting_id' => 1,
            'name' => 'ru',
        ]);

        UserSettingValue::create([
            'user_setting_id' => 1,
            'name' => 'en',
        ]);

        UserSettingValue::create([
            'user_setting_id' => 1,
            'name' => 'ua',
        ]);
    }
}
