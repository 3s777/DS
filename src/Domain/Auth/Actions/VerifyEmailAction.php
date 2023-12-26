<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Verified;

class VerifyEmailAction
{
    public function __invoke(int $id)
    {
        $user = User::find($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
        }

        return $user;
    }
}
