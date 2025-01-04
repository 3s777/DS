<?php

namespace Domain\Auth\Actions;

use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateUserAction
{
    public function __invoke(NewUserDTO $data): ?User
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => bcrypt($data->password),
                'language' => $data->language,
                'first_name' => $data->first_name,
                'slug' => $data->slug,
                'description' => $data->description
            ]);

            event(new Registered($user));

            if($data->is_verified) {
                $verifyAction = app(VerifyEmailAction::class);
                $verifyAction($user->id);
            }

            $user->audit(
                'changeRole',
                [],
                ['roles' => $data->roles]
            );

            $user->syncRoles($data->roles);

            if($data->featured_image) {
                $user->addFeaturedImageWithThumbnail(
                    $data->featured_image,
                    ['small', 'medium']
                );
            }

            DB::commit();

            return $user;
        } catch (Throwable $e) {
            throw new UserCreateEditException($e->getMessage());
        }
    }
}
