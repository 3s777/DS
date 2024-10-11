<?php

namespace Domain\Auth\Actions;

use App\Exceptions\UserCreateEditException;
use Domain\Auth\DTOs\UpdateUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class UpdateUserAction
{
    public function __invoke(UpdateUserDTO $data, User $user): User
    {
        try {
            DB::beginTransaction();

            $user->updateThumbnail($data->thumbnail, $data->thumbnail_uploaded, ['small', 'medium']);

            $user->fill([
                'name' => $data->name,
                'email' => $data->email,
                'language' => $data->language,
                'first_name' => $data->first_name,
                'slug' => $data->slug,
                'description' => $data->description
            ]);

            if($data->password) {
                $user->password = bcrypt($data->password);
            }

            if(!$user->email_verified_at && $data->is_verified) {
                $verifyAction = app(VerifyEmailAction::class);
                $verifyAction($user->id);
            }

            if(!$data->is_verified) {
                $user->email_verified_at = null;
            }

            $user->save();

            $user->audit(
                'changeRole',
                ['roles' => $user->roles->pluck(['name'])],
                ['roles' => $data->roles]
            );

            $user->syncRoles($data->roles);

            $rolePermissions = $user->getPermissionsViaRoles()->pluck( 'name')->toArray();

            $resultPermissions = array_diff($data->permissions ?? [], $rolePermissions);

            $resultPermissions = array_filter(
                $resultPermissions,
                function($permission) use($user) {
                    $isRoleHasPermission = true;

                    foreach($user->roles as $role) {
                        if($role->hasPermissionTo($permission) ) {
                            $isRoleHasPermission = false;
                        }
                    }

                    return $isRoleHasPermission;
                });

            $user->audit(
                'changePermission',
                ['permissions' => $user->permissions->pluck(['name'])],
                ['permissions' => $data->permissions ?? []]
            );

            $user->syncPermissions($resultPermissions);

            DB::commit();

            return $user;
        } catch (Throwable $e) {
            throw new UserCreateEditException($e->getMessage());
        }
    }
}
