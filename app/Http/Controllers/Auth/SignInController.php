<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;


class SignInController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.login');
    }

    public function handle(SignInRequest $request): RedirectResponse
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
            'username' => __('The provided credentials do not match our records.'),
        ])->onlyInput('username');
    }

    public function logout(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
