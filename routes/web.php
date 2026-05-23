<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        if (auth()->check()) {
            return view('pages.home');
        }
        return view('pages.welcome');
    })->name('home');

    Route::get('/reset-password', function () {
        return redirect()->route('password.request');
    })->middleware('guest');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/songs', function () {
        return view('pages.song.index');
    })->name('songs');

    Route::get('/users', function () {
        return view('pages.user.index');
    })->name('users.index');

    Route::prefix('/@{user:screen_name}')->group(function () {
        Route::get('/', function (User $user) {
            return view('pages.user.show', ['user' => $user]);
        })->name('users.show');

        Route::get('/status/{status}', function (User $user, int $status) {
            return view('pages.user.status', ['user' => $user, 'status' => $status]);
        })->whereIn('status', ['1', '2', '3'])->name('users.show.status');

        Route::get('/following', function (User $user) {
            return view('pages.user.following', ['user' => $user]);
        })->name('users.show.following');

        Route::get('/followers', function (User $user) {
            return view('pages.user.followers', ['user' => $user]);
        })->name('users.show.followers');
    });

    Route::get('/settings', function () {
        return view('pages.settings');
    })->name('settings');
});
