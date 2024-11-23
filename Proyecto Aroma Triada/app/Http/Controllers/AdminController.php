<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\Pedido;
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
        $this->verificarAdministrador();
        return view('admin.indexadmin'); // Muestra la vista principal del panel de administración
    }

    // Gestiona los productos en el sistema
        public function gestionarProductos()
    {
        $this->verificarAdministrador(); // Verifica que el usuario sea administrador

        $productos = Producto::all(); // Obtiene todos los productos
        return view('admin.productos-index', compact('productos')); // Retorna la vista con los productos
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
        $this->verificarAdministrador(); // Asegúrate de verificar que sea un administrador

   
    // Validar los datos enviados desde el formulario
    $validated = $request->validate([
        'nombre' => 'required|max:255',         // El nombre es obligatorio y tiene un máximo de 255 caracteres
        'descripcion' => 'nullable',            // La descripción puede ser nula
        'precio' => 'required|numeric|min:0',   // El precio es obligatorio, numérico y mayor o igual a 0
    ]);

    // Crear un nuevo producto con los datos validados
    Producto::create($validated);

    // Redirigir al listado de productos con un mensaje de éxito
    return redirect()->route('admin.gestionarProductos')->with('success', 'Producto creado con éxito.');
}

    // Vista para actualizar un producto

        public function actualizarProducto(Request $request, Producto $producto)
    {
        $this->verificarAdministrador(); // Verifica que sea administrador

    // Validación de los datos enviados
    $validated = $request->validate([
        'nombre' => 'required|max:255',
        'descripcion' => 'nullable',
        'precio' => 'required|numeric|min:0',
    ]);

    // Actualiza el producto con los datos validados
    $producto->update($validated);

    // Redirige al listado de productos con un mensaje de éxito
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

    public function gestionarUsuarios()
    {
        $this->verificarAdministrador(); // Verifica que el usuario sea administrador

        $usuarios = User::all(); // Obtén todos los usuarios
        return view('admin.usuarios-index', compact('usuarios')); // Retorna la vista con los usuarios
    }

    public function editarUsuario(User $usuario)
    {
        $this->verificarAdministrador(); // Verifica que el usuario sea administrador

        $roles = Rol::all(); // Obtén los roles disponibles
        return view('admin.usuarios-edit', compact('usuario', 'roles')); // Retorna la vista para editar un usuario
    }

    public function actualizarUsuario(Request $request, User $usuario)
    {
        $this->verificarAdministrador(); // Verifica que el usuario es administrador
    
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'id_rol' => 'required|exists:roles,id_rol', // Cambiamos 'id' por 'id_rol'
        ]);
    
        $usuario->update($validated); // Actualiza al usuario con los datos validados
    
        return redirect()->route('admin.gestionarUsuarios')->with('success', 'Usuario actualizado con éxito.');
    }
    
    public function verPedidos()
{
    $this->verificarAdministrador(); // Verifica si el usuario es administrador

    $pedidos = Pedido::all(); // Obtiene todos los pedidos
    return view('admin.ventas-index', compact('pedidos')); // Retorna la vista de gestión de ventas con los pedidos
}


}
