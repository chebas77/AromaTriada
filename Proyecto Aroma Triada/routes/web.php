<?php

use App\Http\Controllers\AromaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrackingController;

use Illuminate\Support\Facades\Route;

// Ruta principal (index)
Route::get('/', [AromaController::class, 'index'])->name('aroma.index');

// Grupo de rutas de carrito
Route::prefix('carrito')->group(function () {
    Route::get('/', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
    Route::post('/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/agregar-servicios', [CarritoController::class, 'agregarServicios'])->name('carrito.agregarServicios');
    Route::patch('/actualizar', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
    Route::delete('/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/confirmar', [CarritoController::class, 'confirmarCarrito'])->name('carrito.confirmar');
    Route::get('/confirmado', [CarritoController::class, 'mostrarCarritoConfirmado'])->name('carrito.confirmado');
});

// Rutas de catálogo y detalle de productos
Route::prefix('catalogo')->group(function () {
    Route::get('/', [AromaController::class, 'catalogo'])->name('aroma.catalogo');
    Route::get('/detalle/{tipo}/{id}', [ProductoController::class, 'mostrarDetalle'])->name('detalle.mostrar');
});

// Ruta para mostrar servicios
Route::get('/servicios', [CarritoController::class, 'mostrarServicios'])->name('servicios.mostrar');

// Grupo de rutas de pago
Route::middleware(['auth'])->prefix('payment')->group(function () {
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

Route::get('/tracking', [TrackingController::class, 'mostrar'])->name('tracking.mostrar');


// Grupo de rutas del controlador AromaController
Route::prefix('aroma')->controller(AromaController::class)->group(function () {
    Route::get('/perfil', 'perfil')->name('aroma.perfil');
    Route::get('/registro', 'registro')->name('aroma.registro');
    Route::get('/nosotros', 'nosotros')->name('aroma.nosotros');
    Route::get('/preguntas', 'preguntas')->name('aroma.preguntas');
    Route::get('/productos', 'productos')->name('aroma.productos');
    Route::get('/carrito', 'carrito')->name('aroma.carrito');
    Route::get('/inicioSesion', 'inicioSesion')->name('aroma.inicioSesion');
});

// Rutas protegidas para autenticación
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [AromaController::class, 'index'])->name('dashboard');
    Route::get('/perfil', function () {
        return view('perfil'); // Vista de perfil
    })->name('perfil');
});

// Grupo de rutas para el administrador
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('productos', [AdminController::class, 'gestionarProductos'])->name('admin.gestionarProductos');
    Route::get('productos/crear', [AdminController::class, 'crearProducto'])->name('admin.crearProducto');
    Route::post('productos', [AdminController::class, 'guardarProducto'])->name('admin.guardarProducto');
    Route::get('productos/{producto}/editar', [AdminController::class, 'editarProducto'])->name('admin.editarProducto');
    Route::put('productos/{producto}', [AdminController::class, 'actualizarProducto'])->name('admin.actualizarProducto');
    Route::delete('productos/{producto}', [AdminController::class, 'eliminarProducto'])->name('admin.eliminarProducto');
});
