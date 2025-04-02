<?php

namespace Domain\Auth\Services;

use Domain\Auth\DTOs\FillRoleDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Role;
use Domain\Shelf\DTOs\FillCategoryDTO;
use Domain\Shelf\Models\Category;
use Support\Exceptions\CrudException;
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

                if($role->guard_name === 'collector') {
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

                if($role->guard_name === 'collector') {
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
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function setModelNullOnDelete(int|string|array $ids): void
    {
        if (!is_array($ids)) {
            $ids = explode(",", $ids);
        }

        foreach ($ids as $id) {
            $category = Category::find($id);
            $category->model = null;
            $category->save();
        }
    }
}
