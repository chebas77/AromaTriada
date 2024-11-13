@extends('recursos.app')
@section('title', 'Carrito de Compras')

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-8 text-center">Carrito de Compras</h1>

    @if(session('carrito') && count(session('carrito')) > 0)
        @foreach (session('carrito') as $key => $item)
            <div class="border p-4 mb-4 flex items-center space-x-4 bg-gray-100 rounded-lg">
                <!-- Mostrar la imagen del producto o servicio -->
                <div class="w-24 h-24 bg-gray-200 flex-shrink-0">
                    <img src="#" class="h-full w-full object-cover">
                </div>

                <div class="flex-grow">
                    <h3 class="text-lg font-bold">{{ $item['nombre'] ?? 'Producto sin nombre' }}</h3>
                    <p>Precio unitario: ${{ number_format($item['precio'] ?? 0, 2) }}</p>
                    <p>Tipo: {{ ucfirst($item['tipo'] ?? 'Desconocido') }}</p>

                    <!-- Selector de cantidad para producto o servicio -->
                    <form action="{{ route('carrito.actualizar') }}" method="POST" class="mt-2">
    @csrf
    @method('PATCH') <!-- Esto indica que se debe tratar como PATCH -->
    <input type="hidden" name="id" value="{{ $item['id'] }}">
    
    <label for="cantidad" class="text-gray-600">Cantidad:</label>
    <select name="cantidad" class="border rounded px-2 py-1" onchange="this.form.submit()">
        @for ($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}" {{ $item['cantidad'] == $i ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
    </select>
</form>


                    <!-- Precio total del artículo (precio unitario * cantidad) -->
                    <p class="text-red-500 font-semibold mt-2">Precio Total: ${{ number_format(($item['precio'] ?? 0) * $item['cantidad'], 2) }}</p>
                </div>

                <!-- Botón para eliminar el producto o servicio del carrito -->
                <form action="{{ route('carrito.eliminar') }}" method="POST" class="flex-shrink-0">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                </form>
            </div>
        @endforeach

        <!-- Subtotal General del Carrito -->
        <div class="mt-8 border-t pt-4 text-right">
            <h2 class="text-2xl font-bold">Subtotal: 
                ${{ number_format(array_sum(array_map(function($item) {
                    return $item['precio'] * $item['cantidad'];
                }, session('carrito', []))), 2) }}
            </h2>
        </div>
    @else
        <p class="text-center">No hay productos en el carrito.</p>
    @endif
</section>
@endsection
