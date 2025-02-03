<?php

namespace Domain\Auth\Actions;

use Carbon\Carbon;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewAdminDTO;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(NewAdminDTO $data): User
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'language' => $data->language,
        ]);

        $user->assignRole(config('settings.default_role'));

        event(new Registered($user));

        return $user;
    }
}
