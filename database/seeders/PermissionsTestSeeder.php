<?php

namespace Database\Seeders;

use Domain\Auth\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'entity.*', 'display_name' => 'ru.all']);
        Permission::create(['name' => 'entity.create', 'display_name' => 'ru.create']);
        Permission::create(['name' => 'entity.edit', 'display_name' => 'ru.edit']);
        Permission::create(['name' => 'entity.delete', 'display_name' => 'ru.delete']);
    }
}
