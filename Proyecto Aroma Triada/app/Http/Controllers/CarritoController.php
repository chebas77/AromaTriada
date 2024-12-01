<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // Muestra el contenido del carrito y los servicios disponibles
    public function mostrarCarrito()
    {
        $carrito = session()->get('carrito', []);

        // Calcula el subtotal asegurándote de que cada elemento tenga 'total'
        $subtotal = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['total'] ?? 0);
        }, 0);

        $servicios = Servicio::all();

        return view('aroma.carrito', compact('carrito', 'servicios', 'subtotal'));
    }

    // Agrega servicios al carrito
    public function agregarServicios(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if ($request->has('servicio')) {
            $servicioId = $request->input('servicio');
            $cantidadMozos = $request->input('cantidad_mozos', 1);

            $servicio = Servicio::find($servicioId);

            if ($servicio) {
                $key = 'servicio-' . $servicioId;

                if (strtolower($servicio->nombre) === 'mozo') {
                    $carrito[$key] = [
                        'id' => $servicio->id_servicio,
                        'nombre' => $servicio->nombre,
                        'cantidad' => $cantidadMozos,
                        'precio_unitario' => $servicio->precio,
                        'total' => $servicio->precio * $cantidadMozos,
                        'tipo' => 'servicio',
                    ];
                } else {
                    $carrito[$key] = [
                        'id' => $servicio->id_servicio,
                        'nombre' => $servicio->nombre,
                        'cantidad' => 1,
                        'precio_unitario' => $servicio->precio,
                        'total' => $servicio->precio,
                        'tipo' => 'servicio',
                    ];
                }
            }
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.mostrar')->with('success', 'Servicio agregado al carrito.');
    }

    // Agrega productos al carrito
    public function agregar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        $producto = Producto::findOrFail($request->id);

        $precioUnitario = $request->precio_unitario;
        $cantidad = $request->cantidad;
        $total = $precioUnitario * $cantidad;

        $dedicatoria = $request->input('dedicatoria', 'Sin dedicatoria');

        $carrito[] = [
            'id' => $producto->id_producto,
            'nombre' => $producto->nombre,
            'tipo' => $request->tipo,
            'tamano' => $request->tamano,
            'cantidad' => $cantidad,
            'dedicatoria' => $dedicatoria,
            'precio_unitario' => $precioUnitario,
            'total' => $total,
        ];

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito.');
    }

    // Elimina un producto del carrito
    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        $carrito = session()->get('carrito', []);

        foreach ($carrito as $key => $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                unset($carrito[$key]);
                break;
            }
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito.');
    }

    // Actualiza la cantidad de un producto en el carrito
    public function actualizarCantidad(Request $request)
    {
        $id = $request->input('id');
        $cantidad = $request->input('cantidad');

        $carrito = session()->get('carrito', []);

        foreach ($carrito as $key => $item) {
            if ($item['id'] == $id) {
                $carrito[$key]['cantidad'] = $cantidad;
                $carrito[$key]['total'] = $item['precio_unitario'] * $cantidad;
                break;
            }
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.mostrar')->with('success', 'Cantidad actualizada.');
    }

    // Confirma el carrito y calcula el total
    public function confirmarCarrito()
    {
        
        $carrito = session('carrito', []);

        if (!$carrito || count($carrito) === 0) {
            return redirect()->route('carrito.mostrar')->with('error', 'El carrito está vacío.');
        }

        $totalCarrito = collect($carrito)->sum(function ($item) {
            return $item['precio_unitario'] * $item['cantidad'];
        });

        return view('aroma.carrito_confirmado', compact('carrito', 'totalCarrito'));
    }

    // Muestra detalles de productos
    public function mostrarDetalle($tipo, $id)
    {
        if ($tipo === 'producto') {
            $item = Producto::findOrFail($id);

            if ($item->categoria->nombre === 'Tortas') {
                $tamanos = [
                    ['tamano' => 'Pequeña (20 tajadas)', 'precio' => 50.00],
                    ['tamano' => 'Mediana (30 tajadas)', 'precio' => 80.00],
                    ['tamano' => 'Grande (40 tajadas)', 'precio' => 100.00],
                ];
            } elseif ($item->categoria->nombre === 'Bocaditos') {
                $tamanos = [
                    ['tamano' => 'Pequeño (20 unidades)', 'precio' => 60.00],
                    ['tamano' => 'Mediano (50 unidades)', 'precio' => 120.00],
                    ['tamano' => 'Grande (100 unidades)', 'precio' => 200.00],
                ];
            } else {
                $tamanos = [];
            }

            return view('aroma.productos', compact('item', 'tamanos', 'tipo'));
        }

        abort(404);
    }

    // Guarda el método de entrega

    // Agrega un producto al carrito (simplificado)
    public function agregarAlCarrito(Request $request)
    {

        $carrito = session('carrito', []);

        
        $carrito[] = [

            'id' => $request->id,
            'tipo' => $request->tipo,
            'nombre' => Producto::findOrFail($request->id)->nombre,
            'tamano' => $request->tamano,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'total' => $request->cantidad * $request->precio_unitario,
            
        ];
        
        session(['carrito' => $carrito]);
        
        return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito.');
    }
    public function guardarMetodoEntrega(Request $request)
    {
        $validated = $request->validate([
            'metodo_entrega' => 'required|string',
            'direccion' => 'nullable|string',
        ]);

        session()->put('metodo_entrega', $validated['metodo_entrega']);
        if ($validated['metodo_entrega'] === 'Delivery') {
            session()->put('direccion_entrega', $validated['direccion']);
        }

        return redirect()->route('carrito.confirmar')->with('success', 'Método de entrega actualizado.');
    }
}
