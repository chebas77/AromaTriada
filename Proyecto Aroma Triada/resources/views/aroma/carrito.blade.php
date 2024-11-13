@extends('recursos.app')
@section('title', 'Carrito de Compras')

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-8">Carrito de Compras</h1>

    @if(session('carrito') && count(session('carrito')) > 0)
        @foreach (session('carrito') as $key => $item)
            <div class="border p-4 mb-4">
                <h3 class="text-lg font-bold">{{ $item['nombre'] ?? 'Producto sin nombre' }}</h3>
                <p>Precio: ${{ number_format($item['precio'] ?? 0, 2) }}</p>
                <p>Tipo: {{ ucfirst($item['tipo'] ?? 'Desconocido') }}</p>
                <p>Cantidad: {{ $item['cantidad'] ?? 1 }}</p>

                <!-- Formulario para eliminar el producto o servicio del carrito -->
                <form action="{{ route('carrito.eliminar') }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id" value="{{ $item['id'] ?? '' }}">
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
</form>
            </div>
        @endforeach
    @else
        <p>No hay productos en el carrito.</p>
    @endif
</section>
@endsection
