<?php

namespace App\Http\Controllers\Auth\Collector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Collector\RegisterRequest;
use Domain\Auth\Actions\RegisterNewCollectorAction;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewCollectorDTO;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('content.auth-collector.register');
    }

    public function handle(RegisterRequest $request): RedirectResponse
    {

        // TODO try catch
        app()->bind(RegisterNewUserContract:: class, RegisterNewCollectorAction::class);

        $action = app(RegisterNewUserContract::class);
//
//        $action = new RegisterNewCollectorAction();

        $action(NewCollectorDTO::fromRequest($request));

        flash()->info(__('auth.register_verify'));

        return to_route('collector.login');
    }
}
