<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRegistrar implements RouteRegistrar
{

    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function() {
                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::controller(LoginController::class)->group(function () {
                        Route::get('/login', 'page')->middleware('guest')->name('login');
                        Route::post('/login', 'handle')->middleware('guest', 'throttle:auth')->name('login.handle');
                        Route::delete('/logout', 'logout')->name('logout');
                    });

                    Route::controller(RegisterController::class)->group(function () {
                        Route::get('/register', 'page')->middleware('guest')->name('register');
                        Route::post('/register', 'handle')->middleware('guest','throttle:auth')->name('register.handle');
                    });

                    Route::controller(ForgotPasswordController::class)->group(function () {
                        Route::get('/forgot-password', 'page')->middleware('guest')->name('forgot');
                        Route::post('/forgot-password', 'handle')->middleware('guest')->name('forgot.handle');
                    });

                    Route::controller(ResetPasswordController::class)->group(function () {
                        Route::get('/reset-password/{token}', 'page')->middleware('guest', 'remove.locale')->name('password.reset');
                        Route::post('/reset-password', 'handle')->middleware('guest')->name('password.handle');
                    });

                    Route::controller(VerifyEmailController::class)->group(function () {
                        Route::get('/email/verify', 'page')->name('verification.notice');
                        Route::get('/email/verify/{id}/{hash}', 'handle')->middleware(['remove.locale'])->name('verification.verify');
                        Route::post('/email/verification-notification', 'sendVerifyNotification')->middleware(['throttle:6,1'])->name('verification.send');
                    });
                });
            });
    }
}
