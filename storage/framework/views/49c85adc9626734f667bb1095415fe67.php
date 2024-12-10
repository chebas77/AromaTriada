<?php $__env->startSection('title', 'Carrito Confirmado - Delivery'); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-6 bg-gray-50">
    <h1 class="text-3xl font-extrabold text-center text-gray-900 mb-8">Carrito Confirmado - Delivery</h1>

    <?php if(session('carrito') && count(session('carrito')) > 0): ?>
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Resumen del Carrito</h2>

        <?php $__currentLoopData = session('carrito'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flex justify-between items-center mb-4 border-b pb-4">
            <div>
                <h3 class="text-lg font-bold text-gray-700"><?php echo e($item['nombre']); ?></h3>
                <?php if($item['tipo'] === 'producto'): ?>
                <p class="text-sm text-gray-600">Cantidad: <?php echo e($item['cantidad']); ?></p>
                <?php endif; ?>
                <p class="text-sm text-gray-600">Precio Unitario: S/ <?php echo e(number_format($item['precio_unitario'], 2)); ?></p>
            </div>
            <p class="text-lg font-semibold text-red-600">Subtotal: S/ <?php echo e(number_format($item['precio_unitario'] * $item['cantidad'], 2)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-8 p-6 bg-white rounded-lg shadow-lg max-w-3xl mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Seleccionar Método de Entrega</h3>
        <form id="metodo-entrega-form" method="POST" action="<?php echo e(route('checkout')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Dirección de Entrega -->
            <div id="direccion-container" class="mb-6">
                <label for="direccion_entrega" class="block text-gray-700 font-semibold mb-2">Dirección de Entrega</label>
                <input type="text" id="direccion_entrega" name="direccion_entrega" class="w-full bg-gray-100 border rounded-lg px-4 py-3 text-gray-700" placeholder="Ingresa tu dirección" required>
                
                <!-- Google Map -->
                <div id="map" class="w-full h-64 border rounded-lg mb-4 mt-4"></div>

                <!-- Botón para usar ubicación actual -->
                <button type="button" id="btn-ubicacion-actual" class="bg-blue-600 text-white px-6 py-3 rounded-full shadow-md hover:bg-blue-700 transition duration-300 w-full mt-4">
                    Usar Ubicación Actual
                </button>
            </div>

            <!-- Campos para la fecha y hora de entrega -->
            <div class="mb-6">
    <label for="fecha_entrega" class="block text-gray-700 font-semibold mb-2">Fecha de Entrega</label>
    <input type="date" id="fecha_entrega" name="fecha_entrega" class="w-full border rounded-lg px-4 py-3" required min="<?php echo e(now()->format('Y-m-d')); ?>">
</div>


            <div class="mb-6">
    <label for="hora_entrega" class="block text-gray-700 font-semibold mb-2">Hora de Entrega</label>
    <input type="time" id="hora_entrega" name="hora_entrega" class="w-full border rounded-lg px-4 py-3" required min="09:00" max="22:00">
</div>

            <!-- Total del carrito -->
            <input type="hidden" name="total_carrito" value="<?php echo e($totalCarrito); ?>">

            <!-- Botón para confirmar y proceder -->
            <button type="submit" id="btn-confirmar-metodo" class="bg-black text-white px-8 py-4 rounded-full font-semibold hover:bg-gray-800 transition duration-300 w-full mt-6">
                Confirmar y Proceder al Pago
            </button>
            
        </form>
    </div>

    <?php else: ?>
    <p class="text-center text-gray-600 mt-8">No hay productos en el carrito.</p>
    <?php endif; ?>
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
            mapTypeControl: false,  // Disable map type control
            streetViewControl: false, // Disable street view control
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
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8PiY93EPo4alEeJWIzO4qr6FlJovlk9Y&callback=initMap" async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/delivery.blade.php ENDPATH**/ ?>