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
            <p>Precio unitario: ${{ number_format($item['precio'] ?? 0, 2) }}</p>

            <!-- Selector de cantidad para productos -->
            <form action="{{ route('carrito.actualizar') }}" method="POST" class="mt-2">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $item['id'] }}">

                <label for="cantidad" class="text-gray-600">Cantidad:</label>
                <select name="cantidad" class="border rounded px-2 py-1" onchange="this.form.submit()">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $item['cantidad'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                </select>
            </form>

            <p class="text-red-500 font-semibold mt-2">Total: ${{ number_format(($item['precio'] ?? 0) * $item['cantidad'], 2) }}</p>
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

    <section class="container mx-auto py-12 px-6">
        <h2 class="text-2xl font-bold mt-12">Servicios Disponibles</h2>
        <form id="servicios-form" action="{{ route('carrito.agregarServicios') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                @foreach ($servicios as $servicio)
                <div class="bg-white shadow p-4 rounded text-center">
                    <h3 class="text-lg font-semibold">{{ $servicio->nombre }}</h3>
                    <p class="text-gray-600">${{ number_format($servicio->precio, 2) }}</p>
                    <div class="flex justify-center items-center space-x-2 mt-2">
                        <button type="button" onclick="updateQuantity({{ $servicio->id_servicio }}, -1)" class="px-2 py-1 bg-gray-300 rounded">-</button>
                        <span id="display-{{ $servicio->id_servicio }}" class="text-lg">0</span>
                        <button type="button" onclick="updateQuantity({{ $servicio->id_servicio }}, 1)" class="px-2 py-1 bg-gray-300 rounded">+</button>
                    </div>
                    <input type="hidden" id="quantity-{{ $servicio->id_servicio }}" name="servicios[{{ $servicio->id_servicio }}]" value="0">
                </div>
                @endforeach
            </div>
            <button type="submit" class="bg-black text-white px-6 py-2 rounded-lg w-full mt-6">Agregar Servicios al Carrito</button>
        </form>
    </section>

    <script>
        // Función para actualizar la cantidad de cada servicio
        function updateQuantity(id, delta) {
            const quantityInput = document.getElementById(`quantity-${id}`);
            const display = document.getElementById(`display-${id}`);
            let quantity = parseInt(quantityInput.value) + delta;

            // Asegura que la cantidad no sea negativa
            quantity = quantity < 0 ? 0 : quantity;

            // Actualiza el valor en la interfaz y en el formulario
            quantityInput.value = quantity;
            display.textContent = quantity;

            // Actualiza el resumen del carrito
            updateCartSummary();
        }

        function updateCartSummary() {
            const resumenItems = document.getElementById("resumen-items");
            const totalPrecioEl = document.getElementById("total-precio");

            // Limpia los elementos del resumen
            resumenItems.innerHTML = "";

            let totalPrecio = 0;

            // Itera sobre los servicios para calcular el total
            document.querySelectorAll("input[id^='quantity-']").forEach(input => {
                const id = input.id.split("-")[1];
                const cantidad = parseInt(input.value);
                const servicioPrecio = parseFloat(document.getElementById(`display-${id}`).textContent) || 0;

                if (cantidad > 0) {
                    // Suma el subtotal por cada servicio
                    const subtotal = servicioPrecio * cantidad;
                    totalPrecio += subtotal;

                    // Agrega el servicio al resumen
                    const item = document.createElement("li");
                    item.classList.add("flex", "justify-between");
                    item.innerHTML = `<span>Servicio ${id}</span><span>${cantidad} x $${servicioPrecio} = $${subtotal.toFixed(2)}</span>`;
                    resumenItems.appendChild(item);
                }
            });

            // Actualiza el total en el resumen
            totalPrecioEl.textContent = `$${totalPrecio.toFixed(2)}`;
        }
    </script>
    @endsection