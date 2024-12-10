<?php $__env->startSection('title', 'Detalle del Producto'); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-8"><?php echo e($item->nombre); ?></h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Imagen -->
        <div class="bg-gray-200 h-80 flex items-center justify-center rounded">
            <img src="<?php echo e($item->imagen ? asset($item->imagen) : asset('images/placeholder.png')); ?>"
                alt="<?php echo e($item->nombre); ?>" class="h-full w-full object-cover">
        </div>

        <!-- Detalles -->
        <div>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Detalles</h2>
            <p class="mb-4 text-gray-700"><?php echo e($item->descripcion); ?></p>
            <form action="<?php echo e(route('carrito.agregar')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($item->id_producto); ?>">
                <input type="hidden" name="tipo" value="producto">

                <?php if($item->categoria->nombre === 'Tortas' || $item->categoria->nombre === 'Bocaditos'): ?>
                <!-- Configuración para Tamaño -->
                <label for="tamano" class="block text-gray-700 font-semibold mb-2">Selecciona el tamaño</label>
                <select name="tamano" id="tamano" class="w-full border rounded px-4 py-2 mb-4" onchange="updatePrecio()">
                    <?php $__currentLoopData = $tamanos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tamano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tamano['tamano']); ?>" data-precio="<?php echo e($tamano['precio']); ?>">
                            <?php echo e($tamano['tamano']); ?> - S/ <?php echo e(number_format($tamano['precio'], 2)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <input type="hidden" name="precio_unitario" id="precio-unitario" value="<?php echo e($tamanos[0]['precio']); ?>">
                <?php elseif($item->categoria->nombre === 'Boxes'): ?>
                <!-- Tamaños para Boxes -->
                <label for="tamano" class="block text-gray-700 font-semibold mb-2">Selecciona el tamaño del Box</label>
                <select name="tamano" id="tamano" class="w-full border rounded px-4 py-2 mb-4" onchange="updatePrecio()">
                    <option value="Pequeño" data-precio="<?php echo e($item->precio * 0.5); ?>">Pequeño - S/ <?php echo e(number_format($item->precio * 0.5, 2)); ?></option>
                    <option value="Mediano" data-precio="<?php echo e($item->precio); ?>">Mediano - S/ <?php echo e(number_format($item->precio, 2)); ?></option>
                    <option value="Grande" data-precio="<?php echo e($item->precio * 1.5); ?>">Grande - S/ <?php echo e(number_format($item->precio * 1.5, 2)); ?></option>
                </select>
                <input type="hidden" name="precio_unitario" id="precio-unitario" value="<?php echo e($item->precio); ?>">
                <?php else: ?>
                <!-- Precio fijo para otros productos -->
                <input type="hidden" name="precio_unitario" id="precio-unitario" value="<?php echo e($item->precio); ?>">
                <?php endif; ?>

                <!-- Cantidad -->
                <label for="cantidad" class="block text-gray-700 font-semibold mb-2">Cantidad</label>
                <div class="flex items-center space-x-4 mb-4">
                    <button type="button" class="bg-gray-300 px-4 py-2 rounded" onclick="updateCantidad(-1)">-</button>
                    <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="<?php echo e($item->stock); ?>"
                        class="w-16 border rounded text-center" readonly>
                    <button type="button" class="bg-gray-300 px-4 py-2 rounded" onclick="updateCantidad(1)">+</button>
                </div>

                <?php if($item->categoria->nombre === 'Tortas'): ?>
                <!-- Dedicatoria para Tortas -->
                <label for="dedicatoria" class="block text-gray-700 font-semibold mb-2">¿Desea colocar una dedicatoria?</label>
                <input type="text" name="dedicatoria" id="dedicatoria" maxlength="255"
                    class="w-full border rounded px-4 py-2 mb-4" placeholder="Sin dedicatoria">
                <?php else: ?>
                <!-- Sin dedicatoria para otros -->
                <input type="hidden" name="dedicatoria" value="Sin dedicatoria">
                <?php endif; ?>

                <!-- Precio Total -->
                <p id="precio-total" class="text-xl font-bold text-red-600 mb-4">
                    Total: S/ <?php echo e(number_format($tamanos[0]['precio'], 2)); ?>

                </p>

                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded font-bold hover:bg-blue-600">
                    Agregar al Carrito
                </button>
            </form>

            <!-- Botón para retroceder -->
            <div class="mt-6">
                <a href="<?php echo e(route('aroma.catalogo')); ?>" class="bg-gray-500 text-white px-6 py-2 rounded font-bold hover:bg-gray-600">
                    Retroceder
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    const tamanoSelect = document.getElementById('tamano');
    const cantidadInput = document.getElementById('cantidad');
    const precioTotal = document.getElementById('precio-total');
    const stock = <?php echo e($item->stock); ?>;  // El stock máximo disponible

    // Esta función actualizará la cantidad
    function updateCantidad(delta) {
        let cantidad = parseInt(cantidadInput.value) + delta;
        cantidad = cantidad < 1 ? 1 : cantidad; // Asegura que la cantidad no sea menor que 1
        cantidad = cantidad > stock ? stock : cantidad; // Asegura que la cantidad no supere el stock disponible
        cantidadInput.value = cantidad;
        updatePrecio(); // Actualiza el precio total
    }

    // Esta función actualizará el precio total
    function updatePrecio() {
        const precioUnitario = tamanoSelect.options[tamanoSelect.selectedIndex].getAttribute('data-precio'); // Precio del tamaño seleccionado
        document.getElementById('precio-unitario').value = precioUnitario;
        const cantidad = cantidadInput.value;
        const total = parseFloat(precioUnitario) * parseInt(cantidad); // Calculamos el total
        precioTotal.textContent = `Total: S/ ${total.toFixed(2)}`; // Mostrar el precio total
    }

    // Actualizar el precio cuando se cambia el tamaño o la cantidad
    tamanoSelect.addEventListener('change', updatePrecio);
    cantidadInput.addEventListener('input', updatePrecio);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/productos.blade.php ENDPATH**/ ?>