<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;


use App\Http\Controllers\Auth\Collector\CollectorController;
use App\Http\Controllers\Auth\Collector\ForgotPasswordController;
use App\Http\Controllers\Auth\Collector\LoginController;
use App\Http\Controllers\Auth\Collector\RegisterController;
use App\Http\Controllers\Auth\Collector\ResetPasswordController;
use App\Http\Controllers\Auth\Collector\VerifyEmailController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthCollectorRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::as('collector.')->prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::post('/select-collectors', [CollectorController::class, 'getForSelect'])->name('select-collectors');

                    Route::controller(LoginController::class)->group(function () {
//                        Route::get('/login', 'page')->middleware('guest')->name('login');
                        Route::get('/login', 'page')->middleware('guest:collector')->name('login');
                        Route::post('/login', 'handle')->middleware('guest:collector', 'throttle:auth')->name('login.handle');
                        Route::delete('/logout', 'logout')->name('logout');
                    });

                    Route::controller(RegisterController::class)->group(function () {
                        Route::get('/register', 'page')->middleware('guest:collector')->name('register');
                        Route::post('/register', 'handle')->middleware('guest:collector', 'throttle:auth')->name('register.handle');
                    });

                    Route::controller(ForgotPasswordController::class)->group(function () {
                        Route::get('/forgot-password', 'page')->middleware('guest:collector')->name('forgot');
                        Route::post('/forgot-password', 'handle')->middleware('guest:collector')->name('forgot.handle');
                    });

                    Route::controller(ResetPasswordController::class)->group(function () {
                        Route::get('/reset-password/{token}', 'page')->middleware('guest:collector', 'remove.locale')->name('password.reset');
                        Route::post('/reset-password', 'handle')->middleware('guest:collector')->name('password.handle');
                    });

                    Route::controller(VerifyEmailController::class)->group(function () {
                        Route::get('/email/verify', 'page')->name('verification.notice');
                        Route::get('/email/verify/{id}/{hash}', 'handle')->middleware(['remove.locale'])->name('verification.verify');
                        Route::post('/email/verification-notification', 'sendVerifyNotification')->middleware(['throttle:6,1'])->name('verification.send');
                    });

                });

                Route::as('admin.')->prefix('{locale}/admin')->middleware(['auth', 'verified'])->group(function () {
                    Route::delete('/collectors/delete-selected', [CollectorController::class, 'deleteSelected'])->name('collectors.delete');
                    Route::delete('/collectors/force-delete-selected', [CollectorController::class, 'forceDeleteSelected'])->name('collectors.forceDelete');
                    Route::resource('collectors', CollectorController::class)->middleware(['remove.locale']);
                });
            });
    }
}
