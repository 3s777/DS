<?php

namespace App\Http\Controllers\Auth\Public\Collector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Public\LoginCollectorRequest;
use Domain\Auth\Actions\LoginCollectorAction;
use Domain\Auth\DTOs\LoginCollectorDTO;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class LoginController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth-collector.login');
    }

    public function handle(LoginCollectorRequest $request, LoginCollectorAction $action): RedirectResponse
    {

        $actionData = $action(LoginCollectorDTO::fromRequest($request));

        if (array_key_exists('error', $actionData)) {
            flash()->danger(__($actionData['error']));

            return back()->onlyInput('email');
        }

        if (array_key_exists('not_verified', $actionData)) {
            return to_route('collector.verification.notice');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('search'));
    }

    public function logout(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        auth('collector')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return to_route('home');
    }
}
