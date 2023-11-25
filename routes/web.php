<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//require_once "web/auth.php";

Route::get('/{locale?}', function () {
    return view('welcome');
})->whereIn('locale', config('app.available_locales'));

Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'register_user'])->name('register_user');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login_user'])->name('login_user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
