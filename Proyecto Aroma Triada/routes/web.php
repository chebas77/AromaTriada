<?php

use App\Http\Controllers\AromaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('aroma.index');
});

Route::get('/aroma/index', [AromaController::class, 'index'])->name('aroma.index');


Route::prefix('aroma')->controller(AromaController::class)->group(function () {
    Route::get('/catalogo', 'catalogo')->name('aroma.catalogo');
    Route::get('/aroma/perfil', 'perfil')->name('aroma.perfil');
    Route::get('/registro', 'registro')->name('aroma.registro');
    Route::get('/nosotros', 'nosotros')->name('aroma.nosotros');
    Route::get('/preguntas', 'preguntas')->name('aroma.preguntas');
    Route::get('/productos', 'productos')->name('aroma.productos');
    Route::get('/carrito', 'carrito')->name('aroma.carrito');
    Route::get('/inicioSesion', 'inicioSesion')->name('aroma.inicioSesion');
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
