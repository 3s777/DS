<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentLocale = $request->segment(1);

        //        if(!in_array($currentLocale, config('app.available_locales')) && $currentLocale) {
        //            abort(404);
        //        }

        if(auth()->check()) {
            if($currentLocale != session('locale') && $currentLocale) {
                $currentLanguage = Language::where('slug', $currentLocale)->first();
                if($currentLanguage) {
                    auth()->user()
                        ->language()
                        ->associate($currentLanguage)
                        ->save();
                }
            }
        }

        if(is_null(session('locale'))) {
            session(['locale' => config('app.locale')]);
        }

        if(is_null($currentLocale)) {
            $currentLocale = session('locale');
        }

        app()->setLocale($currentLocale);

        session(['locale' => $currentLocale]);

        URL::defaults(['locale' => $currentLocale]);

        return $next($request);
    }
}
