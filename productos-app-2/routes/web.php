<?php

use Illuminate\Support\Facades\Route;

Route::get('/aroma', function () {
    return view('aroma.index');
});

Route::get('/aroma/perfil', function () {
    return view('aroma.perfil');
});

Route::get('/aroma/registro', function () {
    return view('aroma.registro');
});

Route::get('/aroma/somos', function () {
    return view('aroma.somos');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
