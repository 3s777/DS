<?php

namespace Domain\Auth\Actions;

use Carbon\Carbon;
use Domain\Auth\DTOs\UpdateUserDTO;
use Domain\Auth\Models\User;

class UpdateUserAction
{
    public function __invoke(UpdateUserDTO $data, User $user): User
    {
        $user->updateThumbnail($data->thumbnail, $data->thumbnail_uploaded, ['small', 'medium']);

        $user->fill([
            'name' => $data->name,
            'email' => $data->email,
            'language_id' => $data->language_id,
            'first_name' => $data->first_name,
            'slug' => $data->slug,
            'description' => $data->description
        ]);

        if($data->password) {
            $user->password = bcrypt($data->password);
        }

        if(!$user->email_verified_at && $data->is_verified) {
            $user->email_verified_at = Carbon::now();
        }

        if(!$data->is_verified) {
            $user->email_verified_at = null;
        }

        $user->save();

        $user->syncRoles($data->roles);

        $rolePermissions = $user->getPermissionsViaRoles()->pluck( 'name')->toArray();

        $resultPermissions = array_diff($data->permissions ?? [], $rolePermissions);

        $resultPermissions = array_filter(
            $resultPermissions,
            function($permission) use($user) {
                return !$user->hasPermissionTo($permission);
        });

        $user->syncPermissions($resultPermissions);

        return $user;
    }
}
