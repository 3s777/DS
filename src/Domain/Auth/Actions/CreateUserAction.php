<?php

namespace Domain\Auth\Actions;

use App\Exceptions\UserCreateEditException;
use Carbon\Carbon;
use Domain\Auth\DTOs\NewUserDTO;
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
                'language_id' => $data->language_id,
                'first_name' => $data->first_name,
                'slug' => $data->slug,
                'description' => $data->description
            ]);

            event(new Registered($user));

            if($data->is_verified) {
                $verifyAction = app(VerifyEmailAction::class);
                $verifyAction($user->id);
            }

            $user->syncRoles($data->roles);

            if($data->thumbnail) {
                $user->addImageWithThumbnail(
                    $data->thumbnail,
                    'thumbnail',
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
