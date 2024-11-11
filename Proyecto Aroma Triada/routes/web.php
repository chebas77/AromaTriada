<?php

use App\Http\Controllers\AromaController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

// Ruta principal (index)
Route::get('/', [AromaController::class, 'index'])->name('aroma.index');

// Grupo de rutas para el controlador AromaController
Route::prefix('aroma')->controller(AromaController::class)->group(function () {
    Route::get('/carrito', 'carrito')->name('aroma.carrito');
    Route::get('/index', 'index')->name('aroma.index'); // Evita duplicado con la ruta '/'
    Route::get('/catalogo', 'catalogo')->name('aroma.catalogo');
    Route::get('/perfil', 'perfil')->name('aroma.perfil');
    Route::get('/registro', 'registro')->name('aroma.registro');
    Route::get('/nosotros', 'nosotros')->name('aroma.nosotros');
    Route::get('/preguntas', 'preguntas')->name('aroma.preguntas');
    Route::get('/productos', 'productos')->name('aroma.productos');
    Route::get('/carrito', 'carrito')->name('aroma.carrito');
    Route::get('/inicioSesion', 'inicioSesion')->name('aroma.inicioSesion');
});
// Grupo de rutas protegidas por autenticación
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [AromaController::class, 'index'])->name('dashboard'); // Redirecciona a la vista de inicio

    Route::get('/perfil', function () {
        return view('perfil'); // Asegúrate de que esta vista apunta correctamente a la vista de perfil
    })->name('perfil');
});
