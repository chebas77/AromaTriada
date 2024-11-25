<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.productos-edit', compact('producto')); // Retorna la vista para editar el producto
    }
    // Vista para crear un producto

    public function crearProducto()
    {
        $this->verificarAdministrador(); // Verifica que sea administrador

        return view('admin.productos-create'); // Asegúrate de que esta vista exista
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
    $this->verificarAdministrador();

    // Validar los datos
    $validated = $request->validate([
        'nombre' => 'required|max:255',
        'descripcion' => 'nullable',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('imagen')) {
        $filePath = $request->file('imagen')->store('imagenes_productos', 'public');
        $validated['imagen'] = $filePath;
    }

    Producto::create($validated);

    return redirect()->route('admin.gestionarProductos')->with('success', 'Producto creado con éxito.');
}

    // Vista para actualizar un producto

    public function actualizarProducto(Request $request, Producto $producto)
{
    $request->validate([
        'nombre' => 'required|max:255',
        'descripcion' => 'nullable',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validación de imagen
    ]);

    // Eliminar la imagen anterior si se carga una nueva
    if ($request->hasFile('imagen')) {
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen); // Eliminar la imagen anterior
        }

        // Almacenar la nueva imagen
        $rutaImagen = $request->file('imagen')->store('images', 'public');
        $producto->imagen = $rutaImagen;
    }

    $producto->update([
        'nombre' => $request->input('nombre'),
        'descripcion' => $request->input('descripcion'),
        'precio' => $request->input('precio'),
        'imagen' => $producto->imagen, // Asegúrate de actualizar la imagen
    ]);

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
    ->orderByDesc('fecha') // Ordenar desde la última venta
    ->paginate(10); // Mostrar 10 ventas por página

return view('admin.ventas-index', compact('ventas'));
    }
    
}
