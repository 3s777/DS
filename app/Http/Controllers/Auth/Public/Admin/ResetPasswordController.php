<?php

namespace App\Http\Controllers\Auth\Public\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Public\ResetPasswordAdminRequest;
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
            'content.auth.reset-password',
            ['token' => $token,]
        );
    }

    public function handle(ResetPasswordAdminRequest $request): RedirectResponse
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

            return to_route('admin.login');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
