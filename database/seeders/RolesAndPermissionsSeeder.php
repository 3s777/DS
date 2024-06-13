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

        Permission::create(['name' => 'all.*', 'display_name' => [
            'en' => 'All',
            'ru' => 'Полный доступ'
        ]]);
        Permission::create(['name' => 'all.view', 'display_name' => [
            'en' => 'View All',
            'ru' => 'Просматривать (Полный доступ)'
        ]]);
        Permission::create(['name' => 'all.view_all', 'display_name' => [
            'en' => 'View All',
            'ru' => 'Просматривать все (Полный доступ)'
        ]]);
        Permission::create(['name' => 'all.create', 'display_name' => [
            'en' => 'Create All',
            'ru' => 'Создать (Полный доступ)'
        ]]);
        Permission::create(['name' => 'all.edit', 'display_name' => [
            'en' => 'Edit Permission',
            'ru' => 'Редактировать (Полный доступ)'
        ]]);
        Permission::create(['name' => 'all.delete', 'display_name' => [
            'en' => 'Delete Permission',
            'ru' => 'Удалить (Полный доступ)'
        ]]);

        Permission::create(['name' => 'game_developers.*', 'display_name' => [
            'en' => 'Game Developer. All',
            'ru' => 'Игровой разработчик. Все'
        ]]);
        Permission::create(['name' => 'game_developers.view', 'display_name' => [
            'en' => 'Game Developer. View',
            'ru' => 'Игровой разработчик. Смотреть'
        ]]);
        Permission::create(['name' => 'game_developers.view_all', 'display_name' => [
            'en' => 'Game Developer. View all',
            'ru' => 'Игровой разработчик. Смотреть все'
        ]]);
        Permission::create(['name' => 'game_developers.create', 'display_name' => [
            'en' => 'Game Developer. Create',
            'ru' => 'Игровой разработчик. Создать'
        ]]);
        Permission::create(['name' => 'game_developers.edit', 'display_name' => [
            'en' => 'Game Developer. Edit',
            'ru' => 'Игровой разработчик. Редактировать'
        ]]);
        Permission::create(['name' => 'game_developers.delete', 'display_name' => [
            'en' => 'Game Developer. Delete',
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

        $role = Role::create(['name' => 'admin', 'display_name' => [
            'en' => 'Admin',
            'ru' => 'Администратор'
        ]]);
        $role->givePermissionTo(Permission::whereNotIn('name', ['all.*', 'all.delete'])->get());

        $role = Role::create(['name' => 'super_admin', 'display_name' => [
            'en' => 'Super Admin',
            'ru' => 'Супер администратор'
        ]]);
        $role->givePermissionTo(Permission::all());
    }
}
