@extends('recursos.app')
@section('title', 'Carrito Confirmado')

@section('content')
<section class="container mx-auto py-12 px-1">
    <h1 class="text-3xl font-bold mb-8">Carrito Confirmado</h1>

    @if(session('carrito') && count(session('carrito')) > 0)
    <h2 class="text-2xl font-bold mb-6">Resumen del Carrito</h2>
    <div class="border p-4 bg-gray-100 rounded-lg">
        @foreach (session('carrito') as $key => $item)
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-lg font-bold">{{ $item['nombre'] }}</h3>
                <p>Cantidad: {{ $item['cantidad'] }}</p>
                <p>Precio Unitario: ${{ number_format($item['precio'], 2) }}</p>
            </div>
            <p class="text-red-500 font-semibold">Subtotal: ${{ number_format($item['precio'] * $item['cantidad'], 2) }}</p>
        </div>
        @endforeach
    </div>
    <div class="mt-6 text-right">
        <a href="{{ route('checkout') }}" class="bg-black text-white px-6 py-3 rounded-lg font-bold hover:bg-gray-800">
            Proceder al Pago
        </a>
    </div>
    @else
    <p>No hay productos en el carrito.</p>
    @endif
</section>
@endsection
    