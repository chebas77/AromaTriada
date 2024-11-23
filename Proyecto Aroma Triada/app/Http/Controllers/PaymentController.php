<?php

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
    public function checkout(Request $request)
    {
        // Configurar Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Obtener el carrito de la sesión
        $carrito = session('carrito', []);
        $lineItems = [];

        // Configurar cada producto/servicio para Stripe
        foreach ($carrito as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['nombre'],
                    ],
                    'unit_amount' => $item['precio'] * 100, // Convertir a centavos
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
            $this->guardarVenta();

            return redirect()->route('tracking.mostrar')->with('success', 'Pago exitoso. Aquí está tu información de envío.');
        }

        return redirect()->route('carrito.mostrar')->with('error', 'El pago no fue procesado correctamente.');
    }

    public function guardarVenta()
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para continuar.');
        }

        // Obtén el usuario autenticado
        $usuario = Auth::user();

        // Crear la venta
        $venta = Venta::create([
            'id_usuario' => $usuario->id,
            'fecha' => now(),
            'estado' => 'En proceso',
            'total' => session('total_carrito'), // Asegúrate de que session('total_carrito') no sea null
            'metodo_pago' => 'Tarjeta de crédito', // Agregado en función de la estructura de la tabla
        ]);
        // Guardar los detalles de la venta
        $carrito = session('carrito', []); // Obtener el carrito de la sesión
        foreach ($carrito as $item) {
            DetallePedido::create([
                'id_pedido' => $venta->id_pedido, // Usar el valor correcto de la venta creada
                'id_producto' => $item['tipo'] === 'producto' ? $item['id'] : null,
                'id_servicio' => $item['tipo'] === 'servicio' ? $item['id'] : null,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        // Crear el registro del pago
        Pago::create([
            'id_pedido' => $venta->id_pedido, // Usar el nombre correcto de la llave primaria en 'venta'
            'fecha_pago' => now(),
            'monto' => session('total_carrito'),
            'estado' => 'Completado',
            'metodo' => 'Tarjeta de crédito',
        ]);

        // Crear el tracking
        Tracking::create([
            'id_venta' => $venta->id_pedido, // Usar el nombre correcto de la llave primaria en 'venta'
            'origen' => 'Almacén central',
            'destino' => $usuario->direccion ?? 'Dirección no especificada',
            'estado_actual' => 'Preparando envío',
            'fecha_despacho' => null,
            'fecha_entrega' => null,
        ]);

        // Limpiar datos de la sesión relacionados con el carrito
        session()->forget(['carrito', 'total_carrito']);
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
