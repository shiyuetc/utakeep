<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/home', function () {
    return view('pages.home');
})->name('home')->middleware('auth');

Route::get('/songs', function () {
    return view('pages.song.index');
})->middleware('auth');
