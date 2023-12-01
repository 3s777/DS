<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendEmailVerifyRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
    public function register(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.register');
    }

    public function signUp(SignUpRequest $request): RedirectResponse
    {

        $input = $request->only(['name', 'email', 'password']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('status', __('You need to verify your email'));
    }

    public function login(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.login');
    }

    public function signIn(SignInRequest $request): RedirectResponse
    {
        $credentials = $request->only(['username', 'password', 'remember']);

        $remember = false;

        if(isset($credentials['remember'])) {
            $remember = $credentials['remember'];
        }

        if (Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']], $remember) ||
            Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('search'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function forgot(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.forgot-password');
    }

    public function forgotPassword(ForgotPasswordRequest $request): RedirectResponse
    {

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
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

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
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
            return redirect()->route('verification.notice')->with('status', __('Your email is already verificated'));
        }

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with('status', __('We retry send verification link to your email'));
    }
}
