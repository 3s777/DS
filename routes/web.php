<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

//require_once "web/auth.php";

Route::get('/{locale?}', function () {
    return view('welcome');
})->whereIn('locale', config('app.available_locales'));

Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'signUp')->middleware('throttle:auth')->name('signUp');
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'signIn')->middleware('throttle:auth')->name('signIn');
        Route::delete('/logout', 'logout')->name('logout');
        Route::get('/forgot-password', 'forgot')->middleware('guest')->name('password.request');
        Route::post('/forgot-password', 'forgotPassword')->middleware('guest')->name('password.email');
        Route::get('/reset-password/{token}', 'reset')->middleware('guest', 'remove.locale')->name('password.reset');
        Route::post('/reset-password', 'updatePassword')->middleware('guest')->name('password.update');
        Route::get('/email/verify', 'emailVerify')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware(['remove.locale'])->name('verification.verify');
        Route::post('/email/verification-notification', 'sendVerifyNotification')->middleware(['throttle:6,1'])->name('verification.send');
    });


    Route::get('/dashboard', function () {
        return view('welcome');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/ui', function () {
        return view('content.ui.index');
    })->name('ui');

    Route::get('/game-carrier', function () {
        return view('content.game-carrier.index');
    })->name('game-carrier');

    Route::get('/feed', function () {
        return view('content.feed.index');
    })->name('feed');

    Route::get('/search', function () {
        return view('content.search.index');
    })->name('search');

    Route::get('/users', function () {
        return view('content.users.index');
    })->name('users');

    Route::get('/profile', function () {
        return view('content.profile.index');
    })->name('profile');

    Route::get('/rules', function () {
        return view('content.page.index');
    })->name('rules');

    Route::get('/qa', function () {
        return view('content.page.qa');
    })->name('qa');

    Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');
    });

});
