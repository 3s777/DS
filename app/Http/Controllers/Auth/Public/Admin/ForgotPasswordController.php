<?php

namespace App\Http\Controllers\Auth\Public\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\ForgotPasswordRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

        flash()->info(__($status), 'warning');

        //        if($status === Password::RESET_LINK_SENT) {
        //            flash()->info(__($status), 'warning');
        //        }

        return to_route('admin.forgot');
    }
}
