<?php

namespace Domain\Auth\Actions;

use Domain\Auth\DTOs\UpdateCollectorDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Collector;
use Illuminate\Support\Facades\DB;
use Throwable;

class UpdateCollectorAction
{
    public function __invoke(UpdateCollectorDTO $data, Collector $collector): Collector
    {
        try {
            DB::beginTransaction();

            $collector->updateFeaturedImage($data->featured_image, $data->featured_image_uploaded, ['small', 'medium']);

            $collector->fill([
                'name' => $data->name,
                'email' => $data->email,
                'language' => $data->language,
                'first_name' => $data->first_name,
                'slug' => $data->slug,
                'description' => $data->description
            ]);

            if($data->password) {
                $collector->password = bcrypt($data->password);
            }

            if(!$collector->email_verified_at && $data->is_verified) {
                $verifyAction = app(VerifyEmailAction::class);
                $verifyAction($collector);
            }

            if(!$data->is_verified) {
                $collector->email_verified_at = null;
            }

            $collector->save();

            $collector->audit(
                'changeRole',
                ['roles' => $collector->roles->pluck(['name'])],
                ['roles' => $data->roles]
            );

            $collector->syncRoles($data->roles);

            $rolePermissions = $collector->getPermissionsViaRoles()->pluck( 'name')->toArray();

            $resultPermissions = array_diff($data->permissions ?? [], $rolePermissions);

            $resultPermissions = array_filter(
                $resultPermissions,
                function($permission) use($collector) {
                    $isRoleHasPermission = true;

                    foreach($collector->roles as $role) {
                        if($role->hasPermissionTo($permission) ) {
                            $isRoleHasPermission = false;
                        }
                    }

                    return $isRoleHasPermission;
                });

            $collector->audit(
                'changePermission',
                ['permissions' => $collector->permissions->pluck(['name'])],
                ['permissions' => $data->permissions ?? []]
            );

            $collector->syncPermissions($resultPermissions);

            DB::commit();

            return $collector;
        } catch (Throwable $e) {
            throw new UserCreateEditException($e->getMessage());
        }
    }
}
