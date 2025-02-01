<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;


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

//                    Route::post('/select-users', [UserController::class, 'getForSelect'])->name('select-users');
//                    Route::get('/users', [UserController::class, 'publicIndex'])->name('public-users');
//                    Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
//                        Route::delete('/users/delete-selected', [UserController::class, 'deleteSelected'])->name('users.delete');
//                        Route::delete('/users/force-delete-selected', [UserController::class, 'forceDeleteSelected'])->name('users.forceDelete');
//                        Route::resource('users', UserController::class)->middleware(['remove.locale']);
//                        Route::resource('roles', RoleController::class)->middleware(['remove.locale']);
//                        Route::resource('permissions', PermissionController::class)->middleware(['remove.locale']);
//                    });
                });
            });
    }
}
