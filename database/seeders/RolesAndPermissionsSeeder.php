<?php

namespace Database\Seeders;

use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        Permission::create(['name' => 'game_developers.*', 'display_name' => [
            'en' => 'Edit Permission',
            'ru' => 'Игровой разработчик. Все'
        ]]);
        Permission::create(['name' => 'game_developers.create', 'display_name' => [
            'en' => 'Edit Permission',
            'ru' => 'Игровой разработчик. Создать'
        ]]);
        Permission::create(['name' => 'game_developers.edit', 'display_name' => [
            'en' => 'Edit Permission',
            'ru' => 'Игровой разработчик. Редактировать'
        ]]);
        Permission::create(['name' => 'game_developers.delete', 'display_name' => [
            'en' => 'Edit Permission',
            'ru' => 'Игровой разработчик. Удалить'
        ]]);


        $role = Role::create(['name' => 'user', 'display_name' => [
            'en' => 'User',
            'ru' => 'Пользователь'
        ]]);
        $role->givePermissionTo('game_developers.create');

        $role = Role::create(['name' => 'editor', 'display_name' => [
            'en' => 'Editor',
            'ru' => 'Редактор'
        ]]);
        $role->givePermissionTo('game_developers.*');

        $role = Role::create(['name' => 'super_admin', 'display_name' => [
            'en' => 'Super Admin',
            'ru' => 'Супер администратор'
        ]]);
        $role->givePermissionTo(Permission::all());
    }
}
