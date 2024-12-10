<?php $__env->startSection('title', 'Carrito Confirmado - Recoger en Tienda'); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-6 bg-gray-50">
    <h1 class="text-3xl font-extrabold text-center text-gray-900 mb-8">Carrito Confirmado - Recoger en Tienda</h1>

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

            <div class="flex gap-4 mb-4">
                <button type="button" id="btn-recogo-tienda" class="bg-green-600 text-white px-6 py-3 rounded-full shadow-md hover:bg-green-700 transition duration-300">
                    Recoger en Tienda
                </button>
            </div>

            <input type="text" id="direccion_entrega" name="direccion_entrega" value="Recoger en tienda" readonly class="w-full bg-gray-100 border rounded-lg px-4 py-3 mb-4 text-gray-700">

            <!-- Campos para la fecha y hora de recogida -->
            <div class="mb-6">
                <label for="fecha_entrega" class="block text-gray-700 font-semibold mb-2">Fecha de Recogida</label>
                <input type="date" id="fecha_entrega" name="fecha_entrega" value="<?php echo e(now()->format('Y-m-d')); ?>" class="w-full border rounded-lg px-4 py-3">
            </div>

            <div class="mb-6">
                <label for="hora_entrega" class="block text-gray-700 font-semibold mb-2">Hora de Recogida</label>
                <input type="time" id="hora_entrega" name="hora_entrega" class="w-full border rounded-lg px-4 py-3" required>
            </div>

            <!-- Campo oculto para la fecha -->
            <input type="hidden" name="total_carrito" value="<?php echo e($totalCarrito); ?>">

            <button type="submit" class="bg-black text-white px-8 py-4 rounded-full font-semibold hover:bg-gray-800 transition duration-300 mt-6 w-full">
                Confirmar y Proceder al Pago
            </button>
        </form>
    </div>

    <div class="mt-6 text-center">
        <a href="<?php echo e(route('aroma.carrito')); ?>" class="bg-gray-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-gray-700 transition duration-300">
            Retroceder
        </a>
    </div>
    <?php else: ?>
    <p class="text-center text-gray-600 mt-8">No hay productos en el carrito.</p>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/recoger.blade.php ENDPATH**/ ?>