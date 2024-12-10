@extends('recursos.app') {{-- Cambia esto según el layout principal que uses --}}
@section('title', 'Pago Cancelado')

@section('content')
<section class="container mx-auto py-12 px-6 text-center">
    <h1 class="text-3xl font-bold text-red-600 mb-6">Pago cancelado</h1>
    <p class="text-gray-700 mb-6">
        El proceso de pago fue cancelado. Puedes intentarlo nuevamente.
    </p>
    <a href="{{ route('carrito.mostrar') }}" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
        Volver al carrito
    </a>
</section>
@endsection
