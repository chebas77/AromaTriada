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
                @if ($item['tipo'] === 'producto')
                <p>Cantidad: {{ $item['cantidad'] }}</p>
                @endif
                <p>Precio Unitario: S/ {{ number_format($item['precio_unitario'], 2) }}</p>
            </div>
            <p class="text-red-500 font-semibold">Subtotal: S/ {{ number_format($item['precio_unitario'] * $item['cantidad'], 2) }}</p>
        </div>
        @endforeach
    </div>

    <!-- Formulario único para el método de entrega -->
    <div class="mt-8 p-4 bg-gray-100 rounded-lg">
        <h3 class="text-xl font-bold mb-4">Seleccionar Método de Entrega</h3>
        <form id="metodo-entrega-form" method="POST" action="{{ route('checkout') }}">
            @csrf
            <div class="flex gap-4 mb-4">
                <button type="button" id="btn-recogo-tienda" class="bg-green-500 text-white px-4 py-2 rounded">
                    Recogo en Tienda
                </button>
                <button type="button" id="btn-delivery" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Delivery
                </button>
            </div>

            <div id="direccion-container" class="hidden">
                <label for="direccion_entrega" class="block text-gray-700 font-bold mb-2">Dirección de Entrega</label>
                <input type="text" id="direccion_entrega" name="direccion_entrega" class="w-full border rounded-lg px-4 py-2 mb-4" placeholder="Ingresa tu dirección">
                
                <!-- Google Map -->
                <div id="map" class="w-full h-64 border rounded-lg mb-4"></div>

                <!-- Botón para usar ubicación actual -->
                <button type="button" id="btn-ubicacion-actual" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Usar Ubicación Actual
                </button>
            </div>
            
            <div id="hora-container" class="hidden mt-4">
                <label for="hora_entrega" class="block text-gray-700 font-bold mb-2">Seleccionar Hora de Entrega</label>
                <input type="time" id="hora_entrega" name="hora_entrega" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <!-- Campo oculto para la fecha -->
            <input type="hidden" name="fecha_entrega" id="fecha-entrega-input">

            <!-- Total del carrito -->
            <input type="hidden" name="total_carrito" value="{{ $totalCarrito }}">

            <!-- Botón para confirmar y proceder -->
            <button type="submit" id="btn-confirmar-metodo" class="bg-black text-white px-6 py-3 rounded-lg font-bold hover:bg-gray-800 mt-4">
                Confirmar y Proceder al Pago
            </button>

            <!-- Información confirmada -->
            <div id="info-confirmada" class="hidden mt-6 bg-green-100 p-4 rounded-lg">
                <h4 class="text-lg font-bold">Método de Entrega Confirmado</h4>
                <p id="direccion-confirmada" class="text-gray-700">Dirección: </p>
                <p id="fecha-confirmada" class="text-gray-700">Fecha: </p>
                <p id="hora-confirmada" class="text-gray-700">Hora: </p>
                <div class="mt-6 p-4 bg-gray-100 rounded-lg">
                    <h3 class="text-xl font-bold mb-4">Total del Carrito</h3>
                    <p class="text-2xl font-bold text-red-600">Total: S/ {{ number_format($totalCarrito, 2) }}</p>
                </div>
            </div>
        </form>
    </div>
    @else
    <p>No hay productos en el carrito.</p>
    @endif
    

</section>

<script>
    let map;
    let marker;

    function initMap() {
        const initialLocation = { lat: -12.0464, lng: -77.0428 }; // Lima, Perú
        const geocoder = new google.maps.Geocoder();

        map = new google.maps.Map(document.getElementById("map"), {
            center: initialLocation,
            zoom: 15,
        });

        marker = new google.maps.Marker({
            position: initialLocation,
            map: map,
            draggable: true,
        });

        google.maps.event.addListener(marker, 'dragend', function () {
            const position = marker.getPosition();
            updateAddress(position);
        });

        document.getElementById('btn-ubicacion-actual').addEventListener('click', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const currentLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    map.setCenter(currentLocation);
                    marker.setPosition(currentLocation);
                    updateAddress(currentLocation);
                }, function () {
                    alert('No se pudo obtener la ubicación actual.');
                });
            } else {
                alert('Geolocalización no soportada por tu navegador.');
            }
        });

        function updateAddress(location) {
            geocoder.geocode({ location }, function (results, status) {
                if (status === 'OK' && results[0]) {
                    document.getElementById('direccion_entrega').value = results[0].formatted_address;
                }
            });
        }
    }

    document.getElementById('btn-recogo-tienda').addEventListener('click', function () {
        document.getElementById('direccion-container').classList.add('hidden');
        document.getElementById('hora-container').classList.remove('hidden');
        document.getElementById('direccion_entrega').value = 'Recoger en tienda';
    });

    document.getElementById('btn-delivery').addEventListener('click', function () {
        document.getElementById('direccion-container').classList.remove('hidden');
        document.getElementById('hora-container').classList.remove('hidden');
    });

    document.getElementById('btn-confirmar-metodo').addEventListener('click', function () {
        const direccion = document.getElementById('direccion_entrega').value || 'Recoger en tienda';
        const hora = document.getElementById('hora_entrega').value;
        const fecha = new Date().toISOString().split('T')[0]; // Obtener la fecha actual en formato YYYY-MM-DD

        if (hora) {
            document.getElementById('direccion-entrega-input').value = direccion;
            document.getElementById('fecha-entrega-input').value = fecha;
            document.getElementById('hora-entrega-input').value = hora;

            // Mostrar la información confirmada
            document.getElementById('info-confirmada').classList.remove('hidden');
        } else {
            alert('Por favor, selecciona una hora.');
        }
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8PiY93EPo4alEeJWIzO4qr6FlJovlk9Y&callback=initMap" async defer></script>
@endsection
