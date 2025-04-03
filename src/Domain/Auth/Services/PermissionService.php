<?php

namespace Domain\Auth\Services;

use Domain\Auth\DTOs\FillPermissionDTO;
use Domain\Auth\DTOs\FillRoleDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Domain\Shelf\DTOs\FillCategoryDTO;
use Domain\Shelf\Models\Category;
use Illuminate\Support\HigherOrderTapProxy;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class PermissionService
{
    public function create(FillPermissionDTO $data): HigherOrderTapProxy|Permission
    {
        return Transaction::run(
            function () use ($data) {

                $permission = Permission::create([
                    'name' => $data->name,
                    'display_name' => $data->display_name,
                    'guard_name' => $data->guard_name,
                    'description' => $data->description
                ]);

                return $permission;
            },
            function (Throwable $e) {
                throw new UserCreateEditException($e->getMessage());
            }
        );
    }

    public function update(Permission $permission, FillPermissionDTO $data)
    {
        return Transaction::run(
            function () use ($data, $permission) {

                $permission->fill(
                    [
                        'name' => $data->name,
                        'display_name' => $data->display_name,
                        'guard_name' => $data->guard_name,
                        'description' => $data->description
                    ]
                )->save();

                return $permission;
            },
            function (Throwable $e) {
                throw new UserCreateEditException($e->getMessage());
            }
        );
    }
}
