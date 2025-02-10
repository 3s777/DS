<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Contracts\NewUserDTOContract;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\Exceptions\RegisterException;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Support\Transaction;
use Throwable;

class RegisterNewAdminAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTOContract $data)
    {
        return Transaction::run(
            function() use($data) {
                $user = User::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => bcrypt($data->password),
                    'language' => $data->language,
                ]);

                $user->assignRole(config('settings.default_role'));

                event(new Registered($user));

                return $user;
            },
            function(Throwable $e) {
                throw new RegisterException($e->getMessage());
            }
        );
    }
}
