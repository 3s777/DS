<?php

namespace Admin\Auth\Services;

use Admin\Auth\DTOs\FillRoleDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Role;
use Support\Transaction;
use Throwable;

class RoleService
{
    public function create(FillRoleDTO $data)
    {
        return Transaction::run(
            function () use ($data) {

                $role = Role::create([
                    'name' => $data->name,
                    'display_name' => $data->display_name,
                    'guard_name' => $data->guard_name,
                    'description' => $data->description
                ]);

                $permissions = $data->permissions_admin;

                if ($role->guard_name === 'collector') {
                    $permissions = $data->permissions_collector;
                }

                $role->syncPermissions($permissions);

                $role->audit(
                    'changePermission',
                    [],
                    ['permissions' => $permissions ?? []]
                );

                return $role;
            },
            function (Throwable $e) {
                throw new UserCreateEditException($e->getMessage());
            }
        );
    }

    public function update(Role $role, FillRoleDTO $data)
    {
        return Transaction::run(
            function () use ($data, $role) {

                $role->fill(
                    [
                        'name' => $data->name,
                        'display_name' => $data->display_name,
                        'guard_name' => $data->guard_name,
                        'description' => $data->description
                    ]
                )->save();

                $permissions = $data->permissions_admin;

                if ($role->guard_name === 'collector') {
                    $permissions = $data->permissions_collector;
                }

                $role->syncPermissions($permissions);

                $role->audit(
                    'changePermission',
                    ['permissions' => $role->permissions->pluck(['name'])],
                    ['permissions' => $permissions ?? []]
                );

                return $role;
            },
            function (Throwable $e) {
                throw new UserCreateEditException($e->getMessage());
            }
        );
    }
}
