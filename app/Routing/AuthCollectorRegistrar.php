<?php

namespace App\Routing;

use App\Admin\Http\Controllers\Auth\CollectorController;
use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\CollectorController as PublicCollectorController;
use App\Http\Controllers\Auth\ForgotPasswordCollectorController;
use App\Http\Controllers\Auth\LoginCollectorController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterCollectorController;
use App\Http\Controllers\Auth\ResetPasswordCollectorController;
use App\Http\Controllers\Auth\VerifyEmailCollectorController;
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

                    Route::controller(LoginCollectorController::class)->group(function () {
                        Route::get('/login', 'page')->middleware('guest:collector')->name('login');
                        Route::post('/login', 'handle')->middleware('guest:collector', 'throttle:auth')->name('login.handle');
                        Route::delete('/logout', 'logout')->name('logout');
                    });

                    Route::controller(RegisterCollectorController::class)->group(function () {
                        Route::get('/register', 'page')->middleware('guest:collector')->name('register');
                        Route::post('/register', 'handle')->middleware('guest:collector', 'throttle:auth')->name('register.handle');
                    });

                    Route::controller(ForgotPasswordCollectorController::class)->group(function () {
                        Route::get('/forgot-password', 'page')->middleware('guest:collector')->name('forgot');
                        Route::post('/forgot-password', 'handle')->middleware('guest:collector')->name('forgot.handle');
                    });

                    Route::controller(ResetPasswordCollectorController::class)->group(function () {
                        Route::get('/reset-password/{token}', 'page')->middleware('guest:collector', 'remove.locale')->name('password.reset');
                        Route::post('/reset-password', 'handle')->middleware('guest:collector')->name('password.handle');
                    });

                    Route::controller(VerifyEmailCollectorController::class)->group(function () {
                        Route::get('/email/verify', 'page')->name('verification.notice');
                        Route::get('/email/verify/{id}/{hash}', 'handle')->middleware(['remove.locale'])->name('verification.verify');
                        Route::post('/email/verification-notification', 'sendVerifyNotification')->middleware(['throttle:6,1'])->name('verification.send');
                    });

                });

                Route::prefix('{locale}')
                    ->whereIn('locale', config('app.available_locales'))
                    ->controller(ProfileController::class)
                    ->middleware('auth:collector')
                    ->group(function () {
                        Route::get('/profile', 'show')->name('profile');
                        Route::get('/profile/settings', 'settings')->name('profile.settings');
                        Route::put('/profile/settings', 'updateSettings')->name('profile.settings.update');
                        Route::get('/profile/confidential', 'confidential')->name('profile.confidential');
                        Route::delete('/profile/delete', 'delete')->name('profile.delete');
                    });

                Route::prefix('{locale}')
                    ->whereIn('locale', config('app.available_locales'))
                    ->controller(PublicCollectorController::class)
//                    ->middleware('auth:collector')
                    ->middleware(['remove.locale'])
                    ->group(function () {
                        Route::get('/collectors', 'index')->name('collectors');
                        Route::get('/collector/{collector}', 'show')->name('collector');
                        Route::get('/collector/{collector}/collection', 'showCollection')->name('collector.collection');
                        Route::get('/collector/{collector}/sale', 'showSale')->name('collector.sale');
                        Route::get('/collector/{collector}/auction', 'showAuction')->name('collector.auction');
                        Route::get('/collector/{collector}/wishlist', 'showWishlist')->name('collector.wishlist');
                        Route::get('/collector/{collector}/exchange', 'showExchange')->name('collector.exchange');
                        Route::get('/collector/{collector}/blog', 'showBlog')->name('collector.blog');
                    });

                Route::as('admin.')->prefix('{locale}/admin')->middleware(['auth', 'verified'])->group(function () {
                    Route::post('/select-collectors', [CollectorController::class, 'getForSelect'])->name('select-collectors');

                    Route::delete('/collectors/delete-selected', [CollectorController::class, 'deleteSelected'])->name('collectors.delete');
                    Route::delete('/collectors/force-delete-selected', [CollectorController::class, 'forceDeleteSelected'])->name('collectors.forceDelete');
                    Route::resource('collectors', CollectorController::class)->middleware(['remove.locale']);
                });
            });
    }
}
