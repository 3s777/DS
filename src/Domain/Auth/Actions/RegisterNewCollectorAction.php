<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Contracts\NewUserDTOContract;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\Models\Collector;
use Illuminate\Auth\Events\Registered;

class RegisterNewCollectorAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTOContract $data): Collector
    {
        $collector = Collector::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'language' => $data->language,
        ]);

        $collector->assignRole(config('settings.default_collector_role'));

        event(new Registered($collector));

        return $collector;
    }
}

