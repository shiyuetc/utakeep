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
});

Route::middleware(['auth'])->group(function () {
    Route::get('/songs', function () {
        return view('pages.song.index');
    })->name('songs');

    Route::get('/users', function () {
        return view('pages.user.index');
    })->name('users.index');

    Route::get('/@{user:screen_name}', function (User $user) {
        return view('pages.user.show', ['user' => $user]);
    })->name('users.show');

    Route::get('/settings', function () {
        return view('pages.settings');
    })->name('settings');
});