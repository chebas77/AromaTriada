<?php
//API DE PAGO                 implementa una API de pago para manejar transacciones mediante Stripe
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Venta;
use App\Models\DetallePedido;
use App\Models\Pago;
use App\Models\Tracking;

class PaymentController extends Controller
{
    //se encarga de integrar el flujo de pago, registrar las ventas, procesar detalles de los pedidos, registrar pagos, y seguimiento para envíos.
    public function checkout(Request $request)
    {
        
        session([
            'metodo_entrega' => $request->input('metodo_entrega') === 'Recoger en tienda' ? 'Recogo en tienda' : 'Delivery',
            'direccion_entrega' => $request->input('direccion_entrega'),
            'fecha_entrega' => $request->input('fecha_entrega'),
            'hora_entrega' => $request->input('hora_entrega'),
            'total_carrito' => $request->input('total_carrito'),
        ]);
        // Configurar Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Obtener el carrito de la sesión
        $carrito = session('carrito', []);
        $lineItems = [];

        // Configurar cada producto/servicio para Stripe
        foreach ($carrito as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'pen',
                    'product_data' => [
                        'name' => $item['nombre'],
                    ],
                    'unit_amount' => $item['precio_unitario'] * 100, // Convertir a centavos
                ],
                'quantity' => $item['cantidad'],
            ];
        }

        // Crear la sesión de Stripe Checkout
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
        ]);

        // Redirigir al usuario a Stripe Checkout
        return redirect($session->url, 303);
    }

    public function success(Request $request)
    {

        $session_id = $request->get('session_id');
        Stripe::setApiKey(config('services.stripe.secret'));

        if (!$session_id) {
            return redirect()->route('carrito.mostrar')->with('error', 'No se encontró la sesión de pago.');
        }

        $checkoutSession = Session::retrieve($session_id);

        if ($checkoutSession->payment_status === 'paid') {
            // Recuperar los datos necesarios de la sesión
            // Recuperar datos de la sesión Laravel

            $direccion_entrega = session('direccion_entrega', 'Dirección no especificada');
            $fecha_entrega = session('fecha_entrega', now()->format('Y-m-d'));
            $hora_entrega = session('hora_entrega', '12:00');
            $total_carrito = session('total_carrito', 0);
            $metodo_entrega = session('metodo_entrega', 'Método no especificado');

            $request->merge([

                'direccion_entrega' => $direccion_entrega,
                'fecha_entrega' => $fecha_entrega,
                'hora_entrega' => $hora_entrega,
                'total_carrito' => $total_carrito,
                'metodo_entrega' => $metodo_entrega,
            ]);

            return $this->guardarVenta($request);

            return redirect()->route('tracking.mostrar')->with('success', 'Pago exitoso. Aquí está tu información de envío.');
        }

        return redirect()->route('carrito.mostrar')->with('error', 'El pago no fue procesado correctamente.');
    }

    public function guardarVenta(Request $request)
{
    // Verifica si el usuario está autenticado
    if (!Auth::check()) {
        return redirect()->route('inicioSesion')->with('error', 'Debes iniciar sesión para continuar.');
    }

    // Obtén el usuario autenticado
    $usuario = Auth::user();

    // Crear la venta
    $venta = Venta::create([
    'fecha' => now(),
    'estado' => 'En proceso',
    'total' => $request->input('total_carrito'),
    'metodo_pago' => 'Tarjeta de crédito',
    'metodo_entrega' => $request->input('metodo_entrega', 'Sin especificar'),
    'direccion_entrega' => $request->input('direccion_entrega', 'Sin especificar'),
    'id_usuario' => $usuario->id,
]);

    // Guardar los detalles de la venta
    $carrito = session('carrito', []);
    foreach ($carrito as $item) {
        DetallePedido::create([
            'id_pedido' => $venta->id_pedido,
            'id_producto' => $item['tipo'] === 'producto' ? $item['id'] : null,
            'id_servicio' => $item['tipo'] === 'servicio' ? $item['id'] : null,
            'cantidad' => $item['cantidad'],
            'precio_unitario' => $item['precio_unitario'],
            'tamaño' => $item['tamaño'] ?? null, // Tamaño si aplica
            'dedicatoria' => $item['dedicatoria'] ?? null, // Dedicatoria si aplica
        ]);
    }

    // Crear el registro del pago
    Pago::create([
        'id_pedido' => $venta->id_pedido,
        'fecha_pago' => now(),
        'monto' => $request->input('total_carrito'),
        'estado' => 'Completado',
        'metodo' => 'Tarjeta de crédito',
    ]);

    // Crear el tracking
    Tracking::create([
        'id_venta' => $venta->id_pedido,
        'origen' => 'Almacén central',
        'destino' => $request->input('direccion_entrega'),
        'estado_actual' => 'Preparando envío',
        'fecha_despacho' => null,
        'fecha_entrega' => $request->input('fecha_entrega'),
        'hora_programada' => $request->input('hora_entrega'),
    ]);

    // Limpiar datos de la sesión relacionados con el carrito
    session()->forget(['carrito', 'total_carrito', 'direccion_entrega', 'fecha_entrega', 'hora_entrega', 'metodo_entrega']);

    return redirect()->route('tracking.mostrar')->with('success', 'Tu pedido ha sido registrado exitosamente.');
}

    public function cancel()
    {
        return view('payment.cancel');
    }
}
