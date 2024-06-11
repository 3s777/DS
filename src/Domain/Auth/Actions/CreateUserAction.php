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
    public function __invoke(NewUserDTO $data): User
    {
        try {
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => bcrypt($data->password),
                'language_id' => $data->language_id,
                'first_name' => $data->first_name,
                'slug' => $data->slug,
                'description' => $data->description,
                'email_verified_at' => $data->is_verified ? Carbon::now() : null
            ]);

            if($data->thumbnail) {
                $user->addImageWithThumbnail(
                    $data->thumbnail,
                    'thumbnail',
                    ['small', 'medium']
                );
            }

            $user->syncRoles($data->roles);

            event(new Registered($user));

            return $user;
        } catch (Throwable $e) {
            throw new UserCreateEditException($e->getMessage());
        }
    }
}
