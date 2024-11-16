<?php

use App\Http\Controllers\AromaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Route;


Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');


// Rutas para el catálogo y el detalle del producto
Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('aroma.catalogo');
Route::get('/detalle/{tipo}/{id}', [ProductoController::class, 'mostrarDetalle'])->name('detalle.mostrar');


// Ruta para mostrar el carrito (productos)
Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/carrito/agregar-servicios', [CarritoController::class, 'agregarServicios'])->name('carrito.agregarServicios');

// Ruta para mostrar servicios
Route::get('/servicios', [CarritoController::class, 'mostrarServicios'])->name('servicios.mostrar');

// Ruta para agregar al carrito (productos o servicios)
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::patch('/carrito/actualizar', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');


// Ruta principal (index)
Route::get('/', [AromaController::class, 'index'])->name('aroma.index');

// Grupo de rutas para el controlador AromaController
Route::prefix('aroma')->controller(AromaController::class)->group(function () {
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
