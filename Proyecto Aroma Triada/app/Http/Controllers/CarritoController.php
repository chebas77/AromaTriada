<?php

namespace App\Http\Controllers;

use App\Models\Producto;

use App\Models\Servicio;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Muestra el contenido del carrito
    public function mostrarCarrito()
    {
        // Recuperar los IDs de productos y servicios desde la sesión
        $productoIds = session()->get('producto_ids', []);
        $servicioIds = session()->get('servicio_ids', []);

        // Obtener los detalles de los productos y servicios con los IDs
        $productos = Producto::whereIn('id_producto', $productoIds)->get();
        $servicios = Servicio::whereIn('id_servicio', $servicioIds)->get();

        // Pasar los datos de productos y servicios a la vista del carrito
        return view('aroma.carrito', compact('productos', 'servicios'));
    }

    // Agrega un producto o servicio al carrito
    public function agregar(Request $request)
    {
        $tipo = $request->input('tipo');
        $id = $request->input('id');

        // Obtener el item según el tipo
        $item = $tipo === 'producto' ? Producto::find($id) : Servicio::find($id);

        if ($item) {
            $carrito = session()->get('carrito', []);
            $key = $tipo . '-' . $id;

            // Asignar el ID apropiado de acuerdo al tipo
            $carrito[$key] = [
                'id' => $id,
                'nombre' => $item->nombre,
                'precio' => $item->precio,
                'tipo' => $tipo,
                'cantidad' => 1,
            ];

            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.mostrar')->with('success', 'Artículo agregado al carrito!');
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
}
