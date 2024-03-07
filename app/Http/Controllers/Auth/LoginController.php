<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Domain\Auth\Actions\LoginUserAction;
use Domain\Auth\DTOs\LoginUserDTO;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class LoginController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth.login');
    }

    public function handle(LoginRequest $request, LoginUserAction $action): RedirectResponse
    {
        $actionData = $action(LoginUserDTO::fromRequest($request));

        if(array_key_exists( 'error', $actionData)) {
            flash()->danger(__($actionData['error']));
            return back()->onlyInput('email');
        }

        if($actionData['route'] === 'search') {
            $request->session()->regenerate();
        }

        return to_route($actionData['route']);
    }

    public function logout(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return to_route('home');
    }
}
