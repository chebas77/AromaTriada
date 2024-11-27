@extends('recursos.app')
@section('title', 'Carrito de Compras')

@section('content')
<section class="container mx-auto py-12 px-1">
    <h1 class="text-3xl font-bold mb-8">Carrito de Compras</h1>

    <!-- Productos en el Carrito -->
    @if(session('carrito') && count(session('carrito')) > 0)
    <h2 class="text-2xl font-bold mb-6">Productos en el Carrito</h2>
    @foreach (session('carrito') as $key => $item)
    <div class="border p-4 mb-4 flex items-center space-x-4 bg-gray-100 rounded-lg">
        <div class="w-24 h-24 bg-gray-200 flex-shrink-0">
            <!-- Aquí podrías agregar una imagen del producto si está disponible -->
        </div>
        <div class="flex-grow">
            <h3 class="text-lg font-bold">{{ $item['nombre'] ?? 'Producto sin nombre' }}</h3>

            <!-- Mostrar tamaño solo para productos -->
            @if ($item['tipo'] === 'producto')
            <p class="text-gray-600">Tamaño: {{ $item['tamano'] ?? 'No especificado' }}</p>
            <p class="text-gray-600">Dedicatoria: {{ $item['dedicatoria'] ?? 'Sin dedicatoria' }}</p>
            @endif

            <p>Precio unitario: S/ {{ number_format($item['precio_unitario'] ?? 0, 2) }}</p>

            <!-- Mostrar cantidad solo para productos -->
            @if ($item['tipo'] === 'producto')
            <form action="{{ route('carrito.actualizar') }}" method="POST" class="mt-2">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $item['id'] }}">

                <label for="cantidad" class="text-gray-600">Cantidad:</label>
                <select name="cantidad" class="border rounded px-2 py-1" onchange="this.form.submit()">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $item['cantidad'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </form>
            @endif

            <p class="text-red-500 font-semibold mt-2">Total: S/ {{ number_format(($item['precio_unitario'] ?? 0) * $item['cantidad'], 2) }}</p>
        </div>

        <!-- Botón para eliminar el producto del carrito -->
        <form action="{{ route('carrito.eliminar') }}" method="POST" class="flex-shrink-0">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $item['id'] }}">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
        </form>
    </div>
    @endforeach
    @else
    <p>No hay productos en el carrito.</p>
    @endif

    <!-- Servicios Disponibles -->
    <section class="container mx-auto py-12 px-6">
        <h2 class="text-2xl font-bold mt-12">Servicios Disponibles</h2>
        <form id="servicios-form" action="{{ route('carrito.agregarServicios') }}" method="POST">
            @csrf
            <div class="flex justify-around items-center space-x-4 mt-4">
                @foreach ($servicios as $servicio)
                <label class="bg-white shadow p-4 rounded text-center flex flex-col items-center">
                    <input type="radio" name="servicio" value="{{ $servicio->id_servicio }}" class="mb-2">
                    <h3 class="text-lg font-semibold">{{ $servicio->nombre }}</h3>
                    <p class="text-gray-600">S/ {{ number_format($servicio->precio, 2) }}</p>
                </label>
                @endforeach
            </div>

            <!-- Campo adicional si se selecciona "Mozo" -->
            <div id="mozo-options" class="mt-4 hidden">
                <label for="cantidad_mozos" class="block text-gray-600">Cantidad de Mozos:</label>
                <input type="number" name="cantidad_mozos" id="cantidad_mozos" min="1" value="1" class="border rounded px-4 py-2">
            </div>

            <!-- Botones para agregar servicios y confirmar carrito -->
            <div class="flex justify-between items-center mt-6">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">
                    Agregar Servicios al Carrito
                </button>
            </div>
        </form>

        <!-- Botón para confirmar carrito -->
        <div class="mt-6">
            <form id="confirmar-carrito-form" action="{{ route('carrito.confirmar') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg w-full">
                    Confirmar Carrito
                </button>
            </form>
        </div>
    </section>

    <script>
        // Mostrar campo de cantidad si se selecciona "Mozo"
        const servicioRadios = document.querySelectorAll('input[name="servicio"]');
        const mozoOptions = document.getElementById('mozo-options');

        servicioRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.parentElement.querySelector('h3').textContent.trim().toLowerCase() === 'mozo') {
                    mozoOptions.classList.remove('hidden');
                } else {
                    mozoOptions.classList.add('hidden');
                }
            });
        });
    </script>
</section>
@endsection
