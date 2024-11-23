<?php

use App\Http\Controllers\AromaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Rutas de pago
Route::middleware(['auth'])->prefix('payment')->group(function () {
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Rutas del catálogo y detalle del producto
Route::prefix('catalogo')->group(function () {
    Route::get('/', [ProductoController::class, 'catalogo'])->name('aroma.catalogo');
    Route::get('/detalle/{tipo}/{id}', [ProductoController::class, 'mostrarDetalle'])->name('detalle.mostrar');
});

// Rutas del carrito
Route::prefix('carrito')->group(function () {
    Route::get('/', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
    Route::post('/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/agregar-servicios', [CarritoController::class, 'agregarServicios'])->name('carrito.agregarServicios');
    Route::patch('/actualizar', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
    Route::delete('/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
});

// Rutas de servicios
Route::get('/servicios', [CarritoController::class, 'mostrarServicios'])->name('servicios.mostrar');

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
    Route::get('/dashboard', function () {
        $user = Auth::user();


        // Redirige al administrador al panel de administración
        if ($user->rol->nombre === 'Administrador') {
            return redirect('/admin'); // Redirige al panel de administración
        }

        // Redirige a usuarios normales al dashboard
        return view('dashboard'); // Vista predeterminada del dashboard
    })->name('dashboard');

    Route::get('/perfil', function () {
        return view('perfil'); // Asegúrate de que esta vista apunta correctamente a la vista de perfil
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

    // Visualización de ventas/pedidos
    Route::get('ventas', [AdminController::class, 'verPedidos'])->name('admin.verPedidos');
});
