<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Domain\Auth\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.login');
    }

    public function handle(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password', 'remember']);

        $remember =  $credentials['remember'] ?? false;

        $user = User::where('email', $credentials['email'])->select('email_verified_at')->first();

        if($user && !$user->email_verified_at) {
            return redirect()->route('verification.notice');
        }

        if (Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ], $remember))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('search'));
        }

        return back()->withErrors([
            'email' => __('auth.error.credentials'),
        ])->onlyInput('username');
    }

    public function logout(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect(route('home'));
    }
}
