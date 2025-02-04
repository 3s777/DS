<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifyEmailAction
{
    public function __invoke(MustVerifyEmail $user)
    {
//        $user = User::find($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
        }

        return $user;
    }
}
