<?php

namespace Domain\Auth\Actions;

use Domain\Auth\DTOs\NewAdminDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Support\Transaction;
use Throwable;

class CreateAdminAction
{
    public function __invoke(NewAdminDTO $data): ?User
    {
        return Transaction::run(function () use ($data) {
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

            if ($data->is_verified) {
                $verifyAction = app(VerifyEmailAction::class);
                $verifyAction($user);
            }

            $user->audit(
                'changeRole',
                [],
                ['roles' => $data->roles]
            );

            $user->syncRoles($data->roles);

            if ($data->featured_image) {
                $user->addFeaturedImageWithThumbnail(
                    $data->featured_image,
                    ['small', 'medium']
                );
            }

            return $user;
        },
        function (Throwable $e) {
                throw new UserCreateEditException($e->getMessage());
            }
        );
    }
}
