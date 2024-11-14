@extends('recursos.app')
@section('title', $item->nombre)

@section('content')

<!-- Breadcrumb -->
<div class="container mx-auto py-4 px-6 text-sm text-gray-500">
    <a href="{{ route('aroma.index') }}" class="hover:underline">Inicio</a> / 
    <a href="{{ route('aroma.catalogo') }}" class="hover:underline">Tienda</a> / 
    {{ $item->nombre }}
</div>

<!-- Detalle del Producto/Servicio -->
<section class="container mx-auto py-12 px-6">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Imagen -->
        <div class="md:w-1/2">
            <img src="{{ asset($item->imagen) }}" alt="{{ $item->nombre }}" class="w-full h-80 object-cover rounded">
        </div>

        <!-- Detalles -->
        <div class="md:w-1/2">
            <h1 class="text-3xl font-bold mb-4">{{ $item->nombre }}</h1>
            <p class="text-2xl text-gray-700 mb-4">${{ number_format($item->precio, 2) }}</p>
            <p class="text-gray-700 mb-6">{{ $item->descripcion }}</p>

            <!-- Formulario para agregar al carrito -->
            <form action="{{ route('carrito.agregar') }}" method="POST">
                @csrf
                <input type="hidden" name="tipo" value="{{ $tipoItem }}">
                <input type="hidden" name="id" value="{{ $item->id }}">
                
                <!-- Botón de agregar al carrito -->
                <button type="submit" class="w-full bg-black text-white py-3 font-bold hover:bg-gray-800">
                    AÑADIR AL CARRITO
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Productos Relacionados -->
<section class="container mx-auto py-12 px-6">
    <h2 class="text-2xl font-bold mb-6">Productos Relacionados</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($relacionados as $relacionado)
            <div class="bg-white shadow p-4 rounded">
                <div class="bg-gray-300 h-40 mb-4">
                    <img src="{{ asset($relacionado->imagen) }}" alt="{{ $relacionado->nombre }}" class="h-full w-full object-cover">
                </div>
                <h3 class="text-sm font-bold text-gray-500">{{ $relacionado->categoria->nombre ?? 'Sin categoría' }}</h3>
                <p class="text-gray-800 mb-2">{{ $relacionado->nombre }}</p>
                <p class="text-gray-700 font-bold mb-4">${{ number_format($relacionado->precio, 2) }}</p>

                <!-- Formulario para agregar relacionado al carrito -->
                <form action="{{ route('carrito.agregar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipo" value="producto">
                    <input type="hidden" name="id" value="{{ $relacionado->id }}">
                    <button type="submit" class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">
                        AÑADIR AL CARRITO
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</section>

@endsection
