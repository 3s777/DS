<?php

use Illuminate\Support\Facades\Route;

//require_once "web/auth.php";

Route::get('/{locale?}', function () {
    return view('welcome');
})->whereIn('locale', config('app.available_locales'));

Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {

    Route::get('/dashboard', function () {
        return view('welcome');
    })->middleware(['auth'])->name('dashboard');

    Route::get('/ui', function () {
        return view('content.ui');
    })->name('ui');

    Route::get('/game-carrier', function () {
        return view('content.game-carrier');
    })->name('game-carrier');

});
