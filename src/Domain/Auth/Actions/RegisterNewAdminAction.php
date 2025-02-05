<?php

namespace Domain\Auth\Actions;

use Carbon\Carbon;
use Domain\Auth\Contracts\NewUserDTOContract;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterNewAdminAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTOContract $data): User
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
