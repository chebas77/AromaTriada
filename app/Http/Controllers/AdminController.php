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
        $connectedUsers = DB::table('sessions')->whereNotNull('user_id')->count();
        $totalSales = DB::table('venta')->count();
        $newUsers = DB::table('users')->count();

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
        $this->verificarAdministrador();
        return view('admin.indexadmin', compact('connectedUsers', 'totalSales', 'newUsers', 'salesMonths', 'salesTotals'));
    }

    // Gestiona los productos en el sistema
    public function gestionarProductos(Request $request)
    {

        $categorias = Categoria::all(); // Obtener todas las categorías
        $productosQuery = Producto::with('categoria');

        // Si hay un filtro de categoría, aplicarlo
        if ($request->has('categoria') && $request->categoria != '') {
            $productosQuery->where('id_categoria', $request->categoria);
        }

        $productos = $productosQuery->get();

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
    $validated = $request->validate([
        'nombre' => 'required|max:255',
        'descripcion' => 'nullable',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validación de imagen
    ]);

    if ($request->hasFile('imagen')) {
        // Usar el nombre del producto para generar un nombre único
        $imageName = strtolower(str_replace(' ', '_', $validated['nombre'])) . '.' . $request->imagen->extension();

        // Sobrescribir directamente la imagen existente
        $request->imagen->move(public_path('images'), $imageName);

        // Asignar la nueva ruta al producto
        $validated['imagen'] = 'images/' . $imageName;
    } else {
        // Si no hay nueva imagen, mantener la existente
        $validated['imagen'] = $producto->imagen;
    }

    $producto->update($validated);

    return redirect()->route('admin.gestionarProductos')->with('success', 'Producto actualizado con éxito.');
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

        // Filtrar por nombre si se proporciona un valor
        if ($request->has('nombre') && $request->nombre != '') {
            $query->where('name', 'like', '%' . $request->nombre . '%');
        }

        $usuarios = $query->with('rol')->get(); // Asegúrate de que 'rol' sea la relación correcta

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

        // Obtener el término de búsqueda
        $search = $request->input('search');

        // Consulta para filtrar las ventas por usuario
        $ventas = Venta::with('usuario')
            ->when($search, function ($query, $search) {
                return $query->whereHas('usuario', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderByDesc('id_pedido') // Ordenar por ID de venta descendente
            ->paginate(10); // Mostrar 10 ventas por página

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
