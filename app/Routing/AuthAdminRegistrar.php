<?php

namespace App\Routing;

use App\Admin\Http\Controllers\Auth\AdminController;
use App\Admin\Http\Controllers\Auth\PermissionController;
use App\Admin\Http\Controllers\Auth\RoleController;
use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPasswordAdminController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\RegisterAdminController;
use App\Http\Controllers\Auth\ResetPasswordAdminController;
use App\Http\Controllers\Auth\VerifyEmailAdminController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthAdminRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::as('admin.')->prefix('{locale}/admin')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::controller(LoginAdminController::class)->group(function () {
                        Route::get('/login', 'page')->middleware('guest')->name('login');
                        Route::post('/login', 'handle')->middleware('guest', 'throttle:auth')->name('login.handle');
                        Route::delete('/logout', 'logout')->name('logout');
                    });

                    Route::controller(RegisterAdminController::class)->group(function () {
                        Route::get('/register', 'page')->middleware('guest')->name('register');
                        Route::post('/register', 'handle')->middleware('guest', 'throttle:auth')->name('register.handle');
                    });

                    Route::controller(ForgotPasswordAdminController::class)->group(function () {
                        Route::get('/forgot-password', 'page')->middleware('guest')->name('forgot');
                        Route::post('/forgot-password', 'handle')->middleware('guest')->name('forgot.handle');
                    });

                    Route::controller(ResetPasswordAdminController::class)->group(function () {
                        Route::get('/reset-password/{token}', 'page')->middleware('guest', 'remove.locale')->name('password.reset');
                        Route::post('/reset-password', 'handle')->middleware('guest')->name('password.handle');
                    });

                    Route::controller(VerifyEmailAdminController::class)->group(function () {
                        Route::get('/email/verify', 'page')->name('verification.notice');
                        Route::get('/email/verify/{id}/{hash}', 'handle')->middleware(['remove.locale'])->name('verification.verify');
                        Route::post('/email/verification-notification', 'sendVerifyNotification')->middleware(['throttle:6,1'])->name('verification.send');
                    });


                    //                    Route::get('/findUsers{query?}', [UserController::class, 'getUsers'])->name('find-users');

                    Route::post('/select-users', [AdminController::class, 'getForSelect'])->name('select-users');
                    //                    Route::get('/users', [UserController::class, 'publicIndex'])->name('public-users');
                    Route::middleware(['auth:admin', 'verified'])->group(function () {
                        Route::delete('/users/delete-selected', [AdminController::class, 'deleteSelected'])->name('users.delete');
                        Route::delete('/users/force-delete-selected', [AdminController::class, 'forceDeleteSelected'])->name('users.forceDelete');
                        Route::resource('users', AdminController::class)->middleware(['remove.locale']);
                        Route::resource('roles', RoleController::class)->middleware(['remove.locale']);
                        Route::resource('permissions', PermissionController::class)->middleware(['remove.locale']);
                    });
                });
            });
    }
}
