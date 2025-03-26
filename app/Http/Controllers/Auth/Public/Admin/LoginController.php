<?php

namespace App\Http\Controllers\Auth\Public\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\LoginRequest;
use Domain\Auth\Actions\LoginAdminAction;
use Domain\Auth\DTOs\LoginAdminDTO;
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

    public function handle(LoginRequest $request, LoginAdminAction $action): RedirectResponse
    {
        $actionData = $action(LoginAdminDTO::fromRequest($request));

        if (array_key_exists('error', $actionData)) {
            flash()->danger(__($actionData['error']));

            return back()->onlyInput('email');
        }

        if (array_key_exists('not_verified', $actionData)) {
            return to_route('admin.verification.notice');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('search'));
    }

    public function logout(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        auth()->logout();

        //        request()->session()->invalidate();
        //
        //        request()->session()->regenerateToken();

        return to_route('home');
    }
}
