<?php

namespace App\Http\Controllers\Auth\Collector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Collector\ResetPasswordRequest;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function page(string $token): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'content.auth-collector.reset-password',
            ['token' => $token,]
        );
    }

    public function handle(ResetPasswordRequest $request): RedirectResponse
    {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(
                    ['password' => bcrypt($password),]
                )->setRememberToken(str()->random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            flash()->info(__($status));

            return to_route('collector.login');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
