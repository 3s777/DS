<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if (Route::is('admin.*')) {
                Auth::shouldUse('admin');
                return route('admin.login', ['locale' => $request->segment(1)]);
            } else {
                Auth::shouldUse('collector');
                return route('collector.login', ['locale' => $request->segment(1)]);
            }
        }

        return null;
    }
}
