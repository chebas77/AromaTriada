<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Muestra los servicios disponibles para agregar al carrito
    // Muestra el contenido del carrito y los servicios disponibles
    public function mostrarCarrito()
    {
        // Obtener los productos añadidos al carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Obtener todos los servicios disponibles (asegúrate de que el modelo Servicio esté correctamente configurado)
        $servicios = Servicio::all();

        // Pasar los datos de productos en el carrito y los servicios a la vista
        return view('aroma.carrito', compact('carrito', 'servicios'));
    }
    public function agregarServicios(Request $request)
    {
        $carrito = session()->get('carrito', []);

        foreach ($request->input('servicios', []) as $id => $cantidad) {
            if ($cantidad > 0) {
                $servicio = Servicio::find($id);
                $key = 'servicio-' . $id;

                $carrito[$key] = [
                    'id' => $id,
                    'nombre' => $servicio->nombre,
                    'precio' => $servicio->precio,
                    'cantidad' => $cantidad,
                    'tipo' => 'servicio',
                ];
            }
        }

        session()->put('carrito', $carrito);
        return redirect()->route('carrito.mostrar')->with('success', 'Servicios agregados al carrito');
    }
    // Agrega un producto o servicio al carrito
    public function agregar(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
        }

        // Lógica para agregar el producto al carrito
        $tipo = $request->input('tipo');
        $id = $request->input('id');

        $item = $tipo === 'producto'
            ? Producto::find($id)
            : Servicio::find($id);

        if ($item) {
            $carrito = session()->get('carrito', []);
            $key = $tipo . '-' . $id;

            $carrito[$key] = [
                'id' => $id,
                'nombre' => $item->nombre,
                'precio' => $item->precio,
                'tipo' => $tipo,
                'cantidad' => 1,
            ];

            session()->put('carrito', $carrito);
            $this->actualizarTotalCarrito();
            return redirect()->route('carrito.mostrar')->with('success', 'Artículo agregado al carrito.');
        }

        return redirect()->route('carrito.mostrar')->with('success', 'Artículo agregado al carrito.');
    }
    // Elimina un producto del carrito
    public function eliminar(Request $request)
    {
        // Obtener el id del producto o servicio a eliminar
        $id = $request->input('id');
        $carrito = session()->get('carrito', []);

        // Buscar y eliminar el elemento del carrito usando el id
        foreach ($carrito as $key => $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                unset($carrito[$key]); // Elimina el elemento del carrito
                break;
            }
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        // Redireccionar al carrito con un mensaje de éxito
        return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito.');
    }
    public function actualizarCantidad(Request $request)
    {
        $id = $request->input('id');
        $cantidad = $request->input('cantidad');

        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Actualizar la cantidad en el carrito
        foreach ($carrito as $key => $item) {
            if ($item['id'] == $id) {
                $carrito[$key]['cantidad'] = $cantidad;
                break;
            }
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        return redirect()->route('carrito.mostrar')->with('success', 'Cantidad actualizada.');
    }
    private function actualizarTotalCarrito()
    {
        $carrito = session('carrito', []);
        $totalCarrito = 0;

        foreach ($carrito as $item) {
            $totalCarrito += $item['precio'] * $item['cantidad'];
        }

        session(['total_carrito' => $totalCarrito]);
    }
    public function confirmarCarrito()
    {
        // Verificar si el carrito tiene productos
        $carrito = session('carrito');
        if (!$carrito || count($carrito) === 0) {
            return redirect()->route('carrito.mostrar')->with('error', 'El carrito está vacío.');
        }

        // Redirigir a la vista de carrito confirmado
        return view('aroma.carrito_confirmado', ['carrito' => $carrito]);
    }
}
