<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendEmailVerifyRequest;
use App\Http\Requests\VerifyEmailRequest;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{

    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.forgot-password');
    }

    public function handle(ForgotPasswordRequest $request): RedirectResponse
    {

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status === Password::RESET_LINK_SENT) {
            flash()->info(__($status), 'warning');

            return back();
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function reset( string $token): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.reset-password', [
            'token' => $token
        ]);
    }

    public function updatePassword(ResetPasswordRequest $request): RedirectResponse
    {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(str()->random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if($status === Password::PASSWORD_RESET) {
            flash()->info(__($status));

            return redirect()->route('login');
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function verifyEmail(VerifyEmailRequest $request, $id)
    {
        $user = User::find($id);

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));

            Auth::loginUsingId($user->id);
        }

        return redirect()->route('search')->with('status', __('Your email is verified'));
    }

    public function emailVerify()
    {
        return view('content.auth.verify');
    }

    public function sendVerifyNotification(SendEmailVerifyRequest $request) {
        $user = User::where('email', $request->only(['email']))->first();

        if ($user->hasVerifiedEmail()) {

            flash()->info(__('Your email is already verificated'));

            return redirect()->route('verification.notice');
        }

        $user->sendEmailVerificationNotification();

        flash()->info(__('We retry send verification link to your email'));

        return redirect()->route('verification.notice');
    }
}
