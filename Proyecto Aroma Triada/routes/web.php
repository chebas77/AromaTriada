<?php

use App\Http\Controllers\AromaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\TrackingController; // Para el tracking
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Ruta principal
Route::get('/', [AromaController::class, 'index'])->name('aroma.index');

// Rutas del catálogo
Route::prefix('catalogo')->group(function () {
    Route::get('/', [AromaController::class, 'catalogo'])->name('aroma.catalogo');
   
});


Route::get('/carrito/confirmar', [CarritoController::class, 'confirmarCarrito'])->name('carrito.confirmar');
Route::post('/carrito/procesar', [CarritoController::class, 'procesarCarrito'])->name('carrito.procesar');


// Rutas del carrito
Route::prefix('carrito')->group(function () {
    Route::get('/', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
    Route::post('/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/detalle/{tipo}/{id}', [CarritoController::class, 'mostrarDetalle'])->name('detalle.item');

    Route::post('/agregar-servicios', [CarritoController::class, 'agregarServicios'])->name('carrito.agregarServicios');
    Route::post('/confirmar', [CarritoController::class, 'confirmarCarrito'])->name('carrito.confirmar');
    Route::patch('/actualizar', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
    Route::delete('/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/personalizar-entrega', [CarritoController::class, 'personalizarEntrega'])->name('carrito.personalizarEntrega');
   
    Route::match(['get', 'post'], '/carrito/confirmar', [CarritoController::class, 'confirmarCarrito'])->name('carrito.confirmar');
Route::post('/carrito/metodo-entrega', [CarritoController::class, 'guardarMetodoEntrega'])->name('carrito.metodo_entrega');
Route::post('/carrito/procesar', [CarritoController::class, 'procesarCarrito'])->name('carrito.procesar');

});

// Rutas de servicios
Route::get('/servicios', [CarritoController::class, 'mostrarServicios'])->name('servicios.mostrar');

// Rutas de pago
Route::middleware(['auth'])->prefix('payment')->group(function () {
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout'); // Procesar el pago
    Route::get('/success', [PaymentController::class, 'success'])->name('payment.success'); // Éxito
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel'); // Cancelación
});


// Rutas para el tracking
Route::middleware(['auth'])->prefix('tracking')->group(function () {
    Route::get('/', [TrackingController::class, 'mostrar'])->name('tracking.mostrar');
});

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
    Route::get('/dashboard', function () {
        return redirect()->route('aroma.index'); // Redirige siempre a la página principal
    });

    Route::get('/perfil', function () {
        return view('perfil'); // Mantiene la lógica para el perfil
    })->name('perfil');
});


// Grupo de rutas protegidas para administradores
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Página principal del panel de administración
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Gestión de productos
    Route::get('productos', [AdminController::class, 'gestionarProductos'])->name('admin.gestionarProductos');
    Route::get('productos/crear', [AdminController::class, 'crearProducto'])->name('admin.crearProducto');
    Route::post('productos', [AdminController::class, 'guardarProducto'])->name('admin.guardarProducto');
    Route::get('productos/{producto}/editar', [AdminController::class, 'editarProducto'])->name('admin.editarProducto');
    Route::put('productos/{producto}', [AdminController::class, 'actualizarProducto'])->name('admin.actualizarProducto');
    Route::delete('productos/{producto}', [AdminController::class, 'eliminarProducto'])->name('admin.eliminarProducto');

    // Gestión de servicios
    Route::get('servicios', [AdminController::class, 'gestionarServicios'])->name('admin.gestionarServicios');
    Route::get('servicios/crear', [AdminController::class, 'crearServicio'])->name('admin.crearServicio');
    Route::post('servicios', [AdminController::class, 'guardarServicio'])->name('admin.guardarServicio');
    Route::get('servicios/{servicio}/editar', [AdminController::class, 'editarServicio'])->name('admin.editarServicio');
    Route::put('servicios/{servicio}', [AdminController::class, 'actualizarServicio'])->name('admin.actualizarServicio');
    Route::delete('servicios/{servicio}', [AdminController::class, 'eliminarServicio'])->name('admin.eliminarServicio');

    // Gestión de usuarios
    Route::get('usuarios', [AdminController::class, 'gestionarUsuarios'])->name('admin.gestionarUsuarios');
    Route::post('usuarios/{usuario}/actualizar', [AdminController::class, 'actualizarUsuario'])->name('admin.actualizarUsuario');
    Route::get('usuarios/{usuario}/editar', [AdminController::class, 'editarUsuario'])->name('admin.editarUsuario');
    Route::get('/admin/productos', [AdminController::class, 'gestionarProductos'])->name('admin.gestionarProductos');

    // Visualización de ventas/pedidos
    Route::get('ventas', [AdminController::class, 'verPedidos'])->name('admin.verPedidos');

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/admin/tracking', [TrackingController::class, 'index'])->name('admin.tracking.index');

       Route::get('/admin/tracking/{id}', [TrackingController::class, 'gestionarTracking'])->name('admin.tracking.show');
Route::post('/admin/tracking/{id}', [TrackingController::class, 'updateTracking'])->name('admin.tracking.update');
Route::post('/admin/tracking/{id}/despacho', [TrackingController::class, 'confirmarDespacho'])->name('admin.tracking.despacho');

    });
});
