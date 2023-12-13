<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailVerifyRequest;
use App\Http\Requests\VerifyEmailRequest;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;


class VerifyEmailController extends Controller
{
    public function page()
    {
        return view('content.auth.verify');
    }

    public function handle(VerifyEmailRequest $request, $id)
    {
        $user = User::find($id);

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));

            Auth::loginUsingId($user->id);
        }

        return redirect()->route('search')->with('status', __('Your email is verified'));
    }

    public function sendVerifyNotification(SendEmailVerifyRequest $request) {
        $user = User::where('email', $request->only(['email']))->first();

        if ($user->hasVerifiedEmail()) {

            flash()->info(__('Your email is already verificated'));

            return redirect()->route('verification.notice');
        }

        $user->sendEmailVerificationNotification();

        flash()->info(__('We retry send verification link to your email'));

        return redirect()->route('verification.notice');
    }



}
