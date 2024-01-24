<?php

namespace Domain\Auth\Actions;

use App\Models\Language;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTO $data)
    {
        $language = Language::where('slug', app()->getLocale())->first();
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'language_id' => $language->id
        ]);

        event(new Registered($user));
    }
}
