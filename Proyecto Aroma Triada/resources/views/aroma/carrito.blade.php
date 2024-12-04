@extends('recursos.app')

@section('title', 'Carrito de Compras')

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-900">Carrito de Compras</h1>

    <!-- Productos en el Carrito -->
    @if(session('carrito') && count(session('carrito')) > 0)
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Productos en el Carrito</h2>
    
    <div class="space-y-8">
        @foreach (session('carrito') as $key => $item)
            <div class="flex bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl space-x-6 items-center transition duration-300">
                
                <!-- Obtener el producto de la base de datos según el ID del carrito -->
                @php
                    $producto = \App\Models\Producto::find($item['id']);
                @endphp

                <div class="w-32 h-32">
                    @if ($producto)
                        <img src="{{ $producto->imagen ? asset($producto->imagen) : asset('images/placeholder.png') }}"
                             alt="{{ $producto->nombre }}"
                             class="w-full h-full object-cover rounded-lg">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}"
                             alt="Producto no encontrado"
                             class="w-full h-full object-cover rounded-lg">
                    @endif
                </div>
                
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $item['nombre'] ?? 'Producto sin nombre' }}</h3>
                    @if ($item['tipo'] === 'producto')
                        <p class="text-sm text-gray-600">Tamaño: {{ $item['tamano'] ?? 'No especificado' }}</p>
                        @if ($item['dedicatoria'])
                            <p class="text-sm text-gray-600">Dedicatoria: {{ $item['dedicatoria'] }}</p>
                        @endif
                    @endif
                    
                    <p class="font-semibold text-gray-800 mt-2">Precio unitario: S/ {{ number_format($item['precio_unitario'], 2) }}</p>

                    @if ($item['tipo'] === 'producto')
                        <form action="{{ route('carrito.actualizar') }}" method="POST" class="mt-4">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <div class="flex items-center space-x-4">
                                <label for="cantidad" class="text-gray-600">Cantidad:</label>
                                <select name="cantidad" class="border rounded-lg px-4 py-2 text-gray-800" onchange="this.form.submit()">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ $item['cantidad'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    @endif
                    
                    <p class="text-red-500 font-semibold mt-2">Total: S/ {{ number_format(($item['precio_unitario'] ?? 0) * $item['cantidad'], 2) }}</p>
                </div>
                
                <form action="{{ route('carrito.eliminar') }}" method="POST" class="flex-shrink-0">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                        Eliminar
                    </button>
                </form>
            </div>
        @endforeach
    </div>
    @else
    <p class="text-center text-gray-600 mt-6">Tu carrito está vacío.</p>
    @endif

    <!-- Servicios Disponibles -->
    <section class="container mx-auto py-12 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Servicios Disponibles</h2>
        
        <form id="servicios-form" action="{{ route('carrito.agregarServicios') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
                @foreach ($servicios as $servicio)
                    <label class="bg-white shadow-sm rounded-lg p-6 flex flex-col items-center space-y-4 text-center cursor-pointer transition transform hover:scale-105 hover:shadow-xl">
                        <input type="radio" name="servicio" value="{{ $servicio->id_servicio }}" class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">{{ $servicio->nombre }}</h3>
                        <p class="text-gray-600">S/ {{ number_format($servicio->precio, 2) }}</p>
                    </label>
                @endforeach
            </div>

            <!-- Campo adicional si se selecciona "Mozo" -->
            <div id="mozo-options" class="mt-6 hidden">
                <label for="cantidad_mozos" class="block text-gray-600">Cantidad de Mozos:</label>
                <input type="number" name="cantidad_mozos" id="cantidad_mozos" min="1" value="1" class="border rounded-lg px-4 py-2 text-gray-800">
            </div>

            <!-- Botón para agregar servicios y confirmar carrito -->
            <div class="flex justify-between items-center mt-8">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Agregar Servicios al Carrito
                </button>
            </div>
        </form>

        <!-- Botón para confirmar carrito -->
        <div class="mt-6">
            <form id="confirmar-carrito-form" action="{{ route('carrito.confirmar') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg w-full hover:bg-red-700 transition duration-300">
                    Confirmar Carrito
                </button>
            </form>
        </div>

        <!-- Botón para retroceder -->
        <div class="mt-6">
            <a href="{{ route('aroma.catalogo') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition duration-300">
                Retroceder
            </a>
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
