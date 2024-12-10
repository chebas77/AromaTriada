@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 text-center">
    <h1 class="text-4xl font-bold text-green-600 mb-4">¡Pago exitoso!</h1>
    <p>Gracias por tu compra. Hemos recibido tu pedido.</p>
    <a href="{{ route('aroma.catalogo') }}" class="mt-6 inline-block bg-black text-white px-6 py-3 rounded-lg font-bold hover:bg-gray-800">
        Volver a la tienda
    </a>
</div>
@endsection
