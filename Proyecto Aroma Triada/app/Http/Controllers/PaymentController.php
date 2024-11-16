<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

use Stripe\Checkout\Session;
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
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        // Redirigir al usuario a Stripe Checkout
        return redirect($session->url, 303);
    }

    public function success()
    {
        // Vaciar el carrito tras el pago exitoso
        session()->forget('carrito');

        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
