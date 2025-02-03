<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendEmailVerifyRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use Domain\Auth\Actions\VerifyEmailAction;
use Domain\Auth\Models\User;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function page()
    {
        return view('content.auth.verify');
    }

    public function handle(VerifyEmailRequest $request, VerifyEmailAction $action, $id)
    {
        $user = $action($id);

        Auth::loginUsingId($user->id);

        flash()->info(__('auth.verified'));

        return to_route('search');
    }

    public function sendVerifyNotification(SendEmailVerifyRequest $request)
    {
        $user = User::where('email', $request->only(['email']))->first();

        if ($user->hasVerifiedEmail()) {

            flash()->info(__('auth.verified'));

            return to_route('admin.verification.notice');
        }

        $user->sendEmailVerificationNotification();

        flash()->info(__('auth.verify_retry_send'));

        return to_route('admin.verification.notice');
    }
}
