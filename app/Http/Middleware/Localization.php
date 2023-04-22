<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentLocale = $request->segment(1);

        if(is_null(session('locale'))) {
            session(['locale'=> config('app.locale')]);
        }

        if(is_null($currentLocale)) {
            $currentLocale = session('locale');
        }

        app()->setLocale($currentLocale);

        session(['locale'=> $currentLocale]);

        URL::defaults(['locale' => $currentLocale]);

        return $next($request);
    }
}
