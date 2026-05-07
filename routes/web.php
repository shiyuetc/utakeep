<?php

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
