<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendEmailVerifyCollectorRequest;
use App\Http\Requests\Auth\VerifyEmailCollectorRequest;
use Domain\Auth\Actions\VerifyEmailAction;
use Domain\Auth\Models\Collector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailCollectorController extends Controller
{
    public function page()
    {
        return view('content.auth-collector.verify');
    }

    public function handle(VerifyEmailCollectorRequest $request, VerifyEmailAction $action, $id): RedirectResponse
    {
        $collector = Collector::find($id);

        $action($collector);

        Auth::login($collector);

        flash()->info(__('auth.verified'));

        return to_route('search');
    }

    public function sendVerifyNotification(SendEmailVerifyCollectorRequest $request): RedirectResponse
    {
        $collector = Collector::where('email', $request->only(['email']))->first();

        if ($collector->hasVerifiedEmail()) {

            flash()->info(__('auth.verified'));

            return to_route('collector.verification.notice');
        }

        $collector->sendEmailVerificationNotification();

        flash()->info(__('auth.verify_retry_send'));

        return to_route('collector.verification.notice');
    }
}
