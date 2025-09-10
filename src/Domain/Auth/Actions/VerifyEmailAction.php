<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Exceptions\RegisterException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Support\Transaction;
use Throwable;

class VerifyEmailAction
{
    public function __invoke(MustVerifyEmail $user)
    {
        return Transaction::run(
            function () use ($user) {
                if (!$user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();

                    event(new Verified($user));
                }

                return $user;
            },
            function (Throwable $e) {
                throw new RegisterException($e->getMessage());
            }
        );
    }
}
