<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordCollectorRequest;
use Domain\Auth\Models\Collector;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class ResetPasswordCollectorController extends Controller
{
    public function page(string $token): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'content.auth-collector.reset-password',
            ['token' => $token,]
        );
    }

    public function handle(ResetPasswordCollectorRequest $request): RedirectResponse
    {
        $status = Password::broker('collectors')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Collector $collector, string $password) {
                $collector->forceFill(
                    ['password' => bcrypt($password),]
                )->setRememberToken(str()->random(60));

                $collector->save();

                event(new PasswordReset($collector));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            flash()->info(__($status));

            return to_route('collector.login');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
