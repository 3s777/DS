<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.register');
    }

    public function register_user(CreateUserRequest $request): RedirectResponse
    {

        $input = $request->only(['name', 'email', 'password']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        return redirect()->route('login')->with('status', __('You need to verify your email'));
    }

    public function login(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.login');
    }

    public function login_user(Request $request) {
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

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
