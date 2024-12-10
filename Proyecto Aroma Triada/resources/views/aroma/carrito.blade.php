@extends('recursos.app')

@section('title', 'Carrito de Compras')

@section('content')
<section class="container mx-auto py-20 px-8 mt-10 bg-violeta">
    <h1 class="text-5xl font-extrabold text-center text-crema3 mb-12 tracking-wide">Carrito de Compras</h1>

    <!-- Productos en el Carrito -->
    @if(session('carrito') && count(session('carrito')) > 0)
    <h2 class="text-3xl font-semibold text-center text-crema3 mb-10">Productos en tu Carrito</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
        @foreach (session('carrito') as $key => $item)
            <div class="flex bg-crema2 rounded-2xl shadow-xl p-6 hover:shadow-2xl transform hover:scale-105 transition duration-500 ease-in-out">
                
                <!-- Obtener el producto de la base de datos según el ID del carrito -->
                @php
                    $producto = \App\Models\Producto::find($item['id']);
                @endphp

                <div class="w-40 h-40 overflow-hidden rounded-xl border-4 border-indigo-500">
                    @if ($producto)
                        <img src="{{ $producto->imagen ? asset($producto->imagen) : asset('images/placeholder.png') }}"
                             alt="{{ $producto->nombre }}"
                             class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}"
                             alt="Producto no encontrado"
                             class="w-full h-full object-cover">
                    @endif
                </div>
                
                <div class="flex-grow ml-6">
                    <h3 class="text-2xl font-bold text-indigo-600">{{ $item['nombre'] ?? 'Producto sin nombre' }}</h3>
                    @if ($item['tipo'] === 'producto')
                        <p class="text-lg text-gray-600">Tamaño: {{ $item['tamano'] ?? 'No especificado' }}</p>
                        @if ($item['dedicatoria'])
                            <p class="text-lg text-gray-600">Dedicatoria: {{ $item['dedicatoria'] }}</p>
                        @endif
                    @endif
                    
                    <p class="font-bold text-indigo-800 mt-4">Precio unitario: S/ {{ number_format($item['precio_unitario'], 2) }}</p>

                    @if ($item['tipo'] === 'producto')
                        <form action="{{ route('carrito.actualizar') }}" method="POST" class="mt-4">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <div class="flex items-center space-x-4">
                                <label for="cantidad" class="text-gray-700">Cantidad:</label>
                                <select name="cantidad" class="border-2 rounded-lg px-6 py-3 text-lg text-gray-800 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600" onchange="this.form.submit()">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ $item['cantidad'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    @endif
                    
                    <p class="text-red-600 font-semibold text-2xl mt-4">Total: S/ {{ number_format(($item['precio_unitario'] ?? 0) * $item['cantidad'], 2) }}</p>
                </div>
                
                <form action="{{ route('carrito.eliminar') }}" method="POST" class="flex-shrink-0">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button type="submit" class="bg-red-600 text-white px-8 py-4 rounded-full hover:bg-red-700 transition duration-300">
                        Eliminar
                    </button>
                </form>
            </div>
        @endforeach
    </div>
    @else
    <p class="text-center text-crema3 mt-10 text-lg">Tu carrito está vacío.</p>
    @endif

    <!-- Servicios Disponibles -->
    <section class="mt-20">
        <h2 class="text-3xl font-semibold text-center text-crema3 mb-12">Servicios Disponibles</h2>
        
        <form id="servicios-form" action="{{ route('carrito.agregarServicios') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 mt-6">
                @foreach ($servicios as $servicio)
                    <label class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-500 ease-in-out cursor-pointer flex flex-col items-center space-y-6 text-center">
                        <input type="radio" name="servicio" value="{{ $servicio->id_servicio }}" class="mb-6">
                        <h3 class="text-2xl font-semibold text-violeta">{{ $servicio->nombre }}</h3>
                        <p class="text-lg text-gray-600">S/ {{ number_format($servicio->precio, 2) }}</p>
                    </label>
                @endforeach
            </div>

            <!-- Campo adicional si se selecciona "Mozo" -->
            <div id="mozo-options" class="mt-8 hidden">
                <label for="cantidad_mozos" class="block text-gray-700 text-xl">Cantidad de Mozos:</label>
                <input type="number" name="cantidad_mozos" id="cantidad_mozos" min="1" value="1" class="border-2 rounded-lg px-6 py-3 text-xl text-gray-800 bg-gray-50 focus:ring-2 focus:ring-indigo-600">
            </div>

            <!-- Botón para agregar servicios y confirmar carrito -->
            <div class="flex justify-center mt-10">
                <button type="submit" class="bg-indigo-600 text-white px-10 py-5 rounded-full text-xl hover:bg-indigo-700 transition duration-300">
                    Agregar Servicios al Carrito
                </button>
            </div>
        </form>

        <!-- Botón para confirmar carrito -->
        <div class="mt-10">
            <form id="confirmar-carrito-form" action="{{ route('carrito.confirmar') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-10 py-5 rounded-full w-full text-xl hover:bg-red-700 transition duration-300">
                    Confirmar Carrito
                </button>
            </form>
        </div>

        <!-- Botón para retroceder -->
        <div class="mt-10">
            <a href="{{ route('aroma.catalogo') }}" class="bg-gray-500 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-600 transition duration-300">
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
