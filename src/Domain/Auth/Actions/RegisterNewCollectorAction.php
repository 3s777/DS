<?php

namespace Domain\Auth\Actions;

use Carbon\Carbon;

use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewAdminDTO;
use Domain\Auth\DTOs\NewCollectorDTO;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterNewCollectorAction implements RegisterNewUserContract
{
    public function __invoke(NewCollectorDTO $data): User
    {
        $user = Collector::create([
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

