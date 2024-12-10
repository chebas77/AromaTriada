<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\Categoria;
use App\Models\Tracking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Verifica si el usuario es administrador
    private function verificarAdministrador()
    {
        if (!auth()->check() || !auth()->user()->esAdministrador()) {
            abort(403, 'Acceso no autorizado');
        }
    }

    // Página principal del panel de administración
    public function index()
    {
        // Obtener usuarios conectados, ventas totales y nuevos usuarios
        $connectedUsers = DB::table('sessions')->whereNotNull('user_id')->count();
        $totalSales = DB::table('venta')->count();
        $newUsers = DB::table('users')->where('created_at', '>=', now()->subDays(7))->count(); // Nuevos usuarios en los últimos 7 días
    
        // Datos para el gráfico de cantidad de ventas
        $salesData = DB::table('venta')
            ->selectRaw('MONTH(fecha) as month, COUNT(*) as total_sales')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        // Convertir los datos para el gráfico
        $salesMonths = $salesData->pluck('month')->map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 1)); // Convertir números de mes a nombres
        });
        $salesTotals = $salesData->pluck('total_sales');
    
        // Obtener los productos más vendidos (sin incluir servicios, ya que no hay un campo para distinguirlos)
        $topProducts = DB::table('detalle_pedidos')
            ->select('detalle_pedidos.id_producto', DB::raw('SUM(cantidad) as total_sold'))
            ->join('productos', 'detalle_pedidos.id_producto', '=', 'productos.id_producto') // Hacemos un join con productos
            ->groupBy('detalle_pedidos.id_producto') // Agrupamos por id_producto de la tabla detalle_pedidos
            ->orderByDesc('total_sold') // Ordenamos de forma descendente por las ventas totales
            ->limit(5) // Limitamos a los 5 productos más vendidos
            ->get();
    
        // Obtener los nombres de los productos más vendidos
        $productNames = DB::table('productos')
            ->whereIn('id_producto', $topProducts->pluck('id_producto')) // Solo productos que están en los productos más vendidos
            ->pluck('nombre', 'id_producto'); // Traemos los nombres de los productos
    
        // Preparar datos para el gráfico de pizza
        $soldProducts = $topProducts->map(function ($item) use ($productNames) {
            return [
                'producto_id' => $item->id_producto,
                'total_sold' => $item->total_sold,
                'product_name' => $productNames[$item->id_producto] ?? 'Desconocido', // Asignamos el nombre de producto o 'Desconocido' si no existe
            ];
        });
    
        // Obtener los métodos de entrega más populares (solo Delivery y Recojo en tienda)
        $deliveryMethods = DB::table('venta')
            ->select(DB::raw("CASE WHEN metodo_entrega = 'Delivery' THEN 'Delivery' ELSE 'Recojo en tienda' END as metodo_entrega"), DB::raw('COUNT(*) as total_sales'))
            ->groupBy(DB::raw("CASE WHEN metodo_entrega = 'Delivery' THEN 'Delivery' ELSE 'Recojo en tienda' END"))
            ->orderByDesc('total_sales')
            ->get();
    
        // Preparar los datos para el gráfico
        $methods = $deliveryMethods->pluck('metodo_entrega'); // Delivery, Recojo en tienda
        $salesByMethod = $deliveryMethods->pluck('total_sales'); // Ventas por cada método de entrega
    
        // Productos con stock 0
        $productsOutOfStock = DB::table('productos')
            ->where('stock', 0)
            ->select('nombre', 'id_producto')
            ->get();
    
        // Nuevas ventas y servicios (últimos 7 días como ejemplo)
        $newSalesAndServices = DB::table('venta')
    ->where('created_at', '>=', now()->subDay()) // Filtrar las últimas 24 horas
    ->select('id_pedido', 'total', 'created_at') // Asegúrate de usar los nombres correctos de las columnas
    ->orderBy('created_at', 'desc') // Ordenar por fecha descendente
    ->get();

        // Verificar si el usuario tiene permisos de administrador
        $this->verificarAdministrador();
    
        return view('admin.indexadmin', compact(
            'connectedUsers',
            'totalSales',
            'newUsers',
            'salesMonths',
            'salesTotals',
            'methods',
            'salesByMethod',
            'soldProducts',
            'productsOutOfStock', // Agregado
            'newSalesAndServices' // Agregado
        ));
    }
    


    public function gestionarProductos(Request $request)
{
    $categorias = Categoria::all(); // Obtener todas las categorías
    $productosQuery = Producto::with('categoria');

    // Filtro por categoría
    if ($request->has('categoria') && $request->categoria != '') {
        $productosQuery->where('id_categoria', $request->categoria);
    }

    // Filtro por disponibilidad
    if ($request->has('disponibilidad')) {
        $disponibilidad = $request->disponibilidad;
        if ($disponibilidad === '1') {
            $productosQuery->where('disponibilidad', true);  // Productos disponibles
        } elseif ($disponibilidad === '0') {
            $productosQuery->where('disponibilidad', false); // Productos no disponibles
        }
    }

    // Paginar siempre con 10 productos por página
    $productos = $productosQuery->paginate(10); // Paginación de 10 productos por página

    return view('admin.productos-index', compact('productos', 'categorias'));
}
    // Vista para editar un producto
    public function editarProducto(Producto $producto)
    {

        $this->verificarAdministrador(); // Verifica que el usuario sea administrador
        $categorias = Categoria::all(); // Obtener todas las categorías

        return view('admin.productos-edit', compact('producto', 'categorias')); // Retorna la vista para editar el producto
    }
    // Vista para crear un producto

    public function crearProducto()
    {

        $this->verificarAdministrador(); // Verifica que sea administrador
        $categorias = Categoria::all();
        return view('admin.productos-create', compact('categorias')); // Asegúrate de que esta vista exista
    }

    //Vista para eliminar un producto

    public function eliminarProducto(Producto $producto)
    {
        $this->verificarAdministrador(); // Verifica si el usuario es administrador

        $producto->delete(); // Elimina el producto de la base de datos

        // Redirige al listado de productos con un mensaje de éxito
        return redirect()->route('admin.gestionarProductos')->with('success', 'Producto eliminado con éxito.');
    }

    // Vista para guardar un producto

    public function guardarProducto(Request $request)
    {
        $this->verificarAdministrador(); // Verifica que el usuario sea administrador

        // Validar los datos
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria', // Validar categoría
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imagen
        ]);

        // Verificar si hay imagen
        if ($request->hasFile('imagen')) {
            // Usar el nombre del producto para crear el nombre de la imagen
            $imageName = strtolower(str_replace(' ', '_', $validated['nombre'])) . '.' . $request->imagen->extension(); // Formato de nombre como 'nombreProducto.png'

            // Mover la imagen a la carpeta public/images
            $request->imagen->move(public_path('images'), $imageName);

            // Asignar la ruta completa de la imagen en la base de datos
            $validated['imagen'] = 'images/' . $imageName;
        }

        // Crear el producto con los datos validados y la imagen
        Producto::create($validated);

        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('admin.gestionarProductos')->with('success', 'Producto creado con éxito.');
    }

    // Vista para actualizar un producto
    public function actualizarProducto(Request $request, Producto $producto)
{
    // Validación de los campos del formulario
    $validated = $request->validate([
        'nombre' => 'required|max:255',
        'descripcion' => 'nullable',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',  // Validar el stock (número entero, no negativo)
        'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validación de imagen
    ]);

    // Actualizar el nombre
    $producto->nombre = $validated['nombre'];

    // Actualizar el resto de los campos
    $producto->descripcion = $validated['descripcion'] ?? $producto->descripcion;
    $producto->precio = $validated['precio'];

    // Actualizar el stock
    $producto->stock = $validated['stock'];

    // Actualizar la disponibilidad dependiendo del stock
    $producto->disponibilidad = $producto->stock > 0 ? 1 : 0;

    // Manejo de la imagen (si se ha subido una nueva)
    if ($request->hasFile('imagen')) {
        // Usar el nombre del producto para generar un nombre único para la imagen
        $imageName = strtolower(str_replace(' ', '_', $validated['nombre'])) . '.' . $request->imagen->extension();

        // Mover la imagen al directorio 'images'
        $request->imagen->move(public_path('images'), $imageName);

        // Asignar la nueva ruta de la imagen al producto
        $producto->imagen = 'images/' . $imageName;
    }

    // Guardamos los cambios en el producto
    $producto->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('admin.gestionarProductos')->with('success', 'Producto actualizado con éxito.');
}



    
    public function updateAvailability(Request $request, Producto $producto)
    {
        // Si el stock es 0, se debe marcar la disponibilidad como no disponible (0)
        if ($producto->stock == 0) {
            $producto->disponibilidad = 0;
        } else {
            // Si el stock es mayor que 0, la disponibilidad se puede manejar mediante el checkbox
            $producto->disponibilidad = $request->has('disponibilidad') ? 1 : 0;
        }
    
        // Guardamos el producto con la nueva disponibilidad
        $producto->save();
    
        // Redirigir con mensaje de éxito
        return redirect()->route('admin.gestionarProductos')->with('success', 'Disponibilidad del producto actualizada correctamente.');
    }

    // Gestiona los servicios en el sistema
    public function gestionarServicios()
    {
        $this->verificarAdministrador();

        $servicios = Servicio::all();
        return view('admin.servicios-index', compact('servicios'));
    }

    // Vista para crear un servicio
    public function crearServicio()
    {
        $this->verificarAdministrador();

        return view('admin.servicios-create'); // Asegúrate de crear esta vista
    }

    // Almacena un nuevo servicio
    public function guardarServicio(Request $request)
    {
        $this->verificarAdministrador();

        // Validación de los datos
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
        ]);

        // Crea el servicio
        Servicio::create($validated);

        return redirect()->route('admin.gestionarServicios')->with('success', 'Servicio creado con éxito.');
    }

    // Editar un servicio
    public function editarServicio(Servicio $servicio)
    {
        $this->verificarAdministrador();

        return view('admin.servicios-edit', compact('servicio'));
    }

    // Actualiza un servicio
    public function actualizarServicio(Request $request, Servicio $servicio)
    {
        $this->verificarAdministrador();

        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
        ]);

        $servicio->update($validated);

        return redirect()->route('admin.gestionarServicios')->with('success', 'Servicio actualizado con éxito.');
    }
    // ServicioController.php

    public function actualizarDisponibilidad(Request $request, Servicio $servicio)
    {


        // Actualizar la disponibilidad
        $servicio->disponibilidad = $request->has('disponibilidad') ? 1 : 0;
        $servicio->save();

        return redirect()->route('admin.gestionarServicios')->with('success', 'Disponibilidad actualizada');
    }


    // Elimina un servicio
    public function eliminarServicio(Servicio $servicio)
    {
        $this->verificarAdministrador();

        $servicio->delete();
        return redirect()->route('admin.gestionarServicios')->with('success', 'Servicio eliminado con éxito.');
    }

    public function gestionarUsuarios(Request $request)
    {
        $query = User::query();

        // Filtro por nombre de usuario
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtro por fecha de inicio
        if ($request->filled('fecha_inicio')) {
            $query->where('created_at', '>=', $request->fecha_inicio);
        }

        // Filtro por fecha de fin
        if ($request->filled('fecha_fin')) {
            $query->where('created_at', '<=', $request->fecha_fin);
        }

        // Obtener los usuarios filtrados
        $usuarios = $query->get();

        // Pasar los usuarios y otros datos a la vista
        return view('admin.usuarios-index', compact('usuarios'));
    }


    public function editarUsuario(User $usuario)
    {
        $this->verificarAdministrador(); // Verifica que el usuario sea administrador

        $roles = Rol::all(); // Obtén los roles disponibles
        return view('admin.usuarios-edit', compact('usuario', 'roles')); // Retorna la vista para editar un usuario
    }

    public function actualizarUsuario(Request $request, User $usuario)
    {
        $this->verificarAdministrador(); // Verifica que el usuario sea administrador

        // Valida los datos enviados
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'id_rol' => 'required|exists:roles,id_rol', // Validamos que el rol exista
            'telefono' => 'nullable|max:15',
        ]);

        // Actualiza el usuario con los datos validados
        $usuario->update($validated);

        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect()->route('admin.gestionarUsuarios')->with('success', 'Usuario actualizado con éxito.');
    }
    public function verDetalle($id)
    {
        // Obtener la venta con sus relaciones (usuario, detalles del pedido, productos, servicios)
        $venta = Venta::with(['usuario', 'detalles.producto', 'detalles.servicio'])->findOrFail($id);

        // Retornar la vista de detalles, pasando los datos de la venta
        return view('admin.ventas-detalle', compact('venta'));
    }

    public function verPedidos(Request $request)
    {
        $this->verificarAdministrador(); // Verifica si el usuario es administrador

        // Obtener los términos de búsqueda y filtros
        $search = $request->input('search');
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $estado = $request->input('estado');
        $metodo_entrega = $request->input('metodo_entrega');

        // Consulta para filtrar las ventas
        $ventas = Venta::with('usuario')
            // Filtro por nombre de usuario
            ->when($search, function ($query, $search) {
                return $query->whereHas('usuario', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            // Filtro por fecha de inicio
            ->when($fecha_inicio, function ($query, $fecha_inicio) {
                return $query->where('fecha', '>=', $fecha_inicio);
            })
            // Filtro por fecha de fin
            ->when($fecha_fin, function ($query, $fecha_fin) {
                return $query->where('fecha', '<=', $fecha_fin);
            })
            // Filtro por estado
            ->when($estado, function ($query, $estado) {
                return $query->where('estado', $estado);
            })
            // Filtro por método de entrega
            ->when($metodo_entrega, function ($query, $metodo_entrega) {
                return $query->where('metodo_entrega', $metodo_entrega);
            })
            // Ordenar por ID de venta descendente
            ->orderByDesc('id_pedido')
            // Paginación de 10 ventas por página
            ->paginate(10);

        return view('admin.ventas-index', compact('ventas'));
    }

    public function gestionarTracking($id)
    {
        // Obtiene el tracking por ID con las relaciones necesarias
        $tracking = Tracking::with('venta.usuario')->findOrFail($id);

        // Devuelve la vista para gestionar el tracking
        return view('admin.tracking-gestionar', compact('tracking'));
    }
    public function actualizarTracking(Request $request, $id)
    {
        $request->validate([
            'estado_actual' => 'required|string',
            'fecha_despacho' => 'nullable|date',
        ]);

        // Buscar y actualizar el tracking
        $tracking = Tracking::findOrFail($id);
        $tracking->update([
            'estado_actual' => $request->input('estado_actual'),
            'fecha_despacho' => $request->input('fecha_despacho'),
        ]);

        return redirect()->route('admin.tracking.index')->with('success', 'Tracking actualizado correctamente.');
    }
}
