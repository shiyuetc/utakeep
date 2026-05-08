<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return view('pages.home');
    }
    return view('pages.welcome');
})->name('home')->middleware('web');

Route::get('/songs', function () {
    return view('pages.song.index');
})->name('songs')->middleware('auth');

Route::get('/@{user:screen_name}', function (User $user) {
    return view('pages.user.show', ['user' => $user]);
})->name('users.show')->middleware('auth');
