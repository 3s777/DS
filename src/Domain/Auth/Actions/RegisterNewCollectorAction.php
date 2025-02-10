<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Contracts\NewUserDTOContract;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\Exceptions\RegisterException;
use Domain\Auth\Models\Collector;
use Illuminate\Auth\Events\Registered;
use Support\Transaction;
use Throwable;

class RegisterNewCollectorAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTOContract $data)
    {
        return Transaction::run(
            function() use($data) {
                $collector = Collector::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => bcrypt($data->password),
                    'language' => $data->language,
                ]);

                $collector->assignRole(config('settings.default_collector_role'));

                event(new Registered($collector));

                return $collector;
            },
            function(Throwable $e) {
                throw new RegisterException($e->getMessage());
            }
        );

    }
}

