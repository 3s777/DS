<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Language;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;


class RegisterController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('content.auth.register');
    }

    public function handle(RegisterRequest $request, RegisterNewUserContract $action): RedirectResponse
    {
        // TODO try catch
        $action(NewUserDTO::fromRequest($request));

        flash()->info(__('You need to verify your email'));

        return redirect()->route('login');
    }
}
