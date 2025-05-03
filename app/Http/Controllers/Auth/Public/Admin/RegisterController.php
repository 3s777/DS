<?php

namespace App\Http\Controllers\Auth\Public\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Public\RegisterAdminRequest;
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

        return view('content.auth.register');
    }

    public function handle(RegisterAdminRequest $request, RegisterNewUserContract $action): RedirectResponse
    {
        $action(NewCollectorDTO::fromRequest($request));

        flash()->info(__('auth.register_verify'));

        return to_route('admin.login');
    }
}
