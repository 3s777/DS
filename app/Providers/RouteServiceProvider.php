<?php

namespace App\Providers;

use App\Contracts\RouteRegistrar;
use App\Routing\Api\ApiRegistrar;
use App\Routing\Api\DocumentationRegistrar;
use App\Routing\AppRegistrar;
use App\Routing\AuthAdminRegistrar;
use App\Routing\AuthCollectorRegistrar;
use App\Routing\FilepondRegistrar;
use App\Routing\GameRegistrar;
use App\Routing\PageRegistrar;
use App\Routing\SettingRegistrar;
use App\Routing\ShelfRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    protected array $registrars = [
        SettingRegistrar::class,
        AppRegistrar::class,
        AuthAdminRegistrar::class,
        AuthCollectorRegistrar::class,
        GameRegistrar::class,
        ShelfRegistrar::class,
        PageRegistrar::class,
        FilepondRegistrar::class,
        ApiRegistrar::class,
        DocumentationRegistrar::class
    ];

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function (Registrar $router) {
            $this->mapRoutes($router, $this->registrars);
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('auth', function (Request $request) {
            return Limit::perMinute(20)->by($request->ip)
                ->response(function (Request $request, array $headers) {
                    flash()->danger(__('text'), 'warning');
                    return back();
                    //                    return response('Полегче', ResponseAlias::HTTP_TOO_MANY_REQUESTS);
                });
        });
    }

    protected function mapRoutes(Registrar $router, array $registrars): void
    {
        foreach ($registrars as $registrar) {
            if (! class_exists($registrar) || ! is_subclass_of($registrar, RouteRegistrar::class)) {
                throw new RuntimeException(sprintf(
                    'Cannot map routes \'%s\', it is not a valid routes class',
                    $registrar
                ));
            }

            (new $registrar())->map($router);
        }
    }
}
