<?php

namespace App\Http\Controllers\Auth\Public\Collector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Public\ForgotPasswordCollectorRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.auth-collector.forgot-password');
    }

    public function handle(ForgotPasswordCollectorRequest $request): RedirectResponse
    {
        $status = Password::broker('collectors')->sendResetLink(
            $request->only('email')
        );

        flash()->info(__($status), 'warning');

        return to_route('collector.forgot');
    }
}
