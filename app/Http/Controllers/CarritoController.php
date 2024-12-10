<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller

{ // Muestra detalles de productos
    public function mostrarDetalle($tipo, $id)
    {
        if ($tipo === 'producto') {
            $item = Producto::findOrFail($id);

            // Obtenemos el precio del tamaño Grande desde la base de datos
            $precioGrande = $item->precio; // Suponiendo que el precio grande está en el campo `precio` de la base de datos

            // Verificar si el precio del producto está disponible
            if (!$precioGrande) {
                abort(404, 'Precio no encontrado para el tamaño Grande');
            }

            // Calcular los precios de los otros tamaños en base al tamaño Grande
            if ($item->categoria->nombre === 'Tortas') {
                // Suponemos que el tamaño Grande tiene un precio base y calculamos los otros tamaños proporcionalmente
                $tamanos = [
                    ['tamano' => 'Pequeña (20 tajadas)', 'precio' => $precioGrande * 0.5],  // 50% del precio Grande
                    ['tamano' => 'Mediana (30 tajadas)', 'precio' => $precioGrande * 0.8],  // 80% del precio Grande
                    ['tamano' => 'Grande (40 tajadas)', 'precio' => $precioGrande],        // Precio base para Grande
                ];
            } elseif ($item->categoria->nombre === 'Bocaditos') {
                // Aplicamos la misma lógica proporcional para los Bocaditos
                $tamanos = [
                    ['tamano' => 'Pequeño (20 unidades)', 'precio' => $precioGrande * 0.6],  // 60% del precio Grande
                    ['tamano' => 'Mediano (50 unidades)', 'precio' => $precioGrande * 1],    // 100% del precio Grande
                    ['tamano' => 'Grande (100 unidades)', 'precio' => $precioGrande * 2],    // 200% del precio Grande
                ];
            } else {
                $tamanos = [];
            }

            return view('aroma.productos', compact('item', 'tamanos', 'tipo'));
        }

        abort(404);
    }
    // Muestra el contenido del carrito y los servicios disponibles
    public function mostrarCarrito()
    {
        $productos = Producto::all();
        $carrito = session()->get('carrito', []);

        // Calcula el subtotal asegurándote de que cada elemento tenga 'total'
        $subtotal = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['total'] ?? 0);
        }, 0);

        $servicios = Servicio::all();

        return view('aroma.carrito', compact('carrito', 'servicios', 'subtotal', 'productos'));
    }
    // Agrega un producto al carrito (simplificado)
    public function agregarAlCarrito(Request $request)
{
    // Recuperar el carrito existente de la sesión o inicializarlo vacío
    $carrito = session('carrito', []);

    // Si la imagen no es proporcionada por el frontend, se usará una imagen por defecto
    $imagen = $request->imagen ? asset($request->imagen) : asset('images/placeholder.png');

    // Obtener el producto de la base de datos
    $producto = Producto::findOrFail($request->id);

    // Añadir el nuevo producto al carrito
    $carrito[] = [
        'imagen' => $imagen, // Imagen de la solicitud o la imagen predeterminada
        'id' => $request->id,
        'tipo' => $request->tipo,
        'nombre' => $producto->nombre,
        'tamano' => $request->tamano,
        'cantidad' => $request->cantidad,
        'precio_unitario' => $request->precio_unitario,
        'total' => $request->cantidad * $request->precio_unitario,
        'dedicatoria' => $request->dedicatoria ?? 'Sin dedicatoria', // Agregar dedicatoria si existe
    ];

    // Guardar el carrito actualizado en la sesión
    session(['carrito' => $carrito]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito.');
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
    public function evaluarCarrito(Request $request)
{
    
    // Obtener el carrito de la sesión
    $carrito = session()->get('carrito', []);

    // Verificar si el carrito está vacío
    if (empty($carrito)) {
        return redirect()->route('carrito.mostrar')->with('error', 'El carrito está vacío.');
    }

    // Variables para acumular los totales
    $totalProductos = 0;
    $totalServicios = 0;
    $totalCarrito = 0;

    // Recorrer el carrito y analizar su contenido
    foreach ($carrito as $item) {
        // Si es un producto
        if ($item['tipo'] === 'producto') {
            $totalProductos += $item['total'];  // Acumulamos el total de los productos
        }

        // Si es un servicio
        if ($item['tipo'] === 'servicio') {
            $totalServicios += $item['total'];  // Acumulamos el total de los servicios
        }
    }

    // Calcular el total del carrito (productos + servicios)
    $totalCarrito = $totalProductos + $totalServicios;

    // Verificar el método de entrega en el carrito
    $metodoEntrega = session()->get('metodo_entrega', 'Recojo en tienda'); // Si no existe, predeterminado a "Recojo en tienda"

    // Verificamos si el carrito tiene Delivery
    $isDelivery = false;
    foreach ($carrito as $item) {
        if ($item['tipo'] === 'servicio' && strtolower($item['nombre']) === 'delivery') {
            $isDelivery = true;
            break;
        }
    }

    // Si el método de entrega es "Delivery", verificamos que haya una dirección
    if ($isDelivery) {
        $direccionEntrega = session()->get('direccion_entrega', null);
        if (is_null($direccionEntrega)) {
            dd('El carrito tiene Delivery pero no se ha especificado una dirección de entrega.');
        }
    }

    // Asignamos el método de entrega final para la vista
    if (!$isDelivery) {
        // Si no hay Delivery, asignamos "Recojo en tienda" como predeterminado
        session()->put('metodo_entrega', 'Recojo en tienda');
    }

    // Ahora redirigimos al carrito confirmado
    return redirect()->route('carrito.confirmar')->with([
        'success' => 'Método de entrega actualizado.',
        'metodo_entrega' => session('metodo_entrega'),
        'direccion_entrega' => $direccionEntrega ?? null,
    ]);
}

    

    // Guarda el método de entrega
    public function guardarMetodoEntrega(Request $request)
{
    $validated = $request->validate([
        'metodo_entrega' => 'required|string',
        'direccion' => 'nullable|string',  // Dirección solo si es Delivery
    ]);

    // Verificamos si el método de entrega es "Recojo en tienda" o "Delivery"
    session()->put('metodo_entrega', $validated['metodo_entrega']);
    
    if ($validated['metodo_entrega'] !== 'Recojo en tienda') {
        // Si el método de entrega no es "Recojo en tienda", asumimos que es Delivery y guardamos la dirección
        session()->put('direccion_entrega', $validated['direccion']);
    }

    return redirect()->route('carrito.confirmar')->with('success', 'Método de entrega actualizado.');
}

    // Confirma el carrito y calcula el total
    public function confirmarCarrito(Request $request)
{
    // Obtener el carrito de la sesión
    $carrito = session('carrito', []);

    // Verificar si el carrito tiene un ítem de tipo "Delivery"
    $isDelivery = false;
    foreach ($carrito as $item) {
        if ($item['tipo'] === 'servicio' && strtolower($item['nombre']) === 'delivery') {
            $isDelivery = true;
            break;
        }
    }

    // Calcular el total del carrito
    $totalCarrito = 0;
    foreach ($carrito as $item) {
        $totalCarrito += $item['precio_unitario'] * $item['cantidad'];  // Calcular el subtotal por producto y acumularlo
    }

    // Obtener los valores de la sesión relacionados con la entrega
    $metodoEntrega = session('metodo_entrega', 'Recoger en tienda');
    $direccionEntrega = session('direccion_entrega', 'Recoger en tienda');
    $horaEntrega = session('hora_entrega', null);

    // Guardar el total calculado en la sesión
    session(['total_carrito' => $totalCarrito]);

    // Si el carrito tiene un servicio de "Delivery", redirigir a la vista de delivery con el mapa
    if ($isDelivery) {
        return view('aroma.delivery', compact('carrito', 'metodoEntrega', 'direccionEntrega', 'horaEntrega', 'totalCarrito'));
    }

    // De lo contrario, redirigir a la vista de "Recoger en tienda"
    return view('aroma.recoger', compact('carrito', 'metodoEntrega', 'direccionEntrega', 'horaEntrega', 'totalCarrito'));
}

    public function guardarDatosCarrito(Request $request)
    {
        $metodoEntrega = $request->input('direccion_entrega') === 'Recoger en tienda' 
            ? 'Recojo en tienda' 
            : 'Delivery';

        session([
            'metodo_entrega' => $metodoEntrega, 
            'direccion_entrega' => $request->input('direccion_entrega'),
            'fecha_entrega' => $request->input('fecha_entrega'),
            'hora_entrega' => $request->input('hora_entrega'),
            'total_carrito' => $request->input('total_carrito'),
        ]);

        return redirect()->route('carrito.confirmar'); // Redirigir a la página de confirmación del carrito
    }
    
}
