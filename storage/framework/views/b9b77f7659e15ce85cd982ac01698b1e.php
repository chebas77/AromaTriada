<?php $__env->startSection('title', 'Detalle de la Venta'); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Detalle de la Venta #<?php echo e($venta->id_pedido); ?></h1>

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl mx-auto">
        <!-- Información General -->
        <p class="mb-4"><strong>Usuario:</strong> <?php echo e($venta->usuario->name ?? 'N/A'); ?></p>
        <p class="mb-4"><strong>Fecha:</strong> <?php echo e($venta->fecha->format('d/m/Y')); ?></p>
        <p class="mb-4"><strong>Total:</strong> S/ <?php echo e(number_format($venta->total, 2)); ?></p>
        <p class="mb-4"><strong>Método de Pago:</strong> <?php echo e($venta->metodo_pago); ?></p>
        <p class="mb-4"><strong>Método de Entrega:</strong> <?php echo e($venta->metodo_entrega); ?></p>
        <p class="mb-4"><strong>Dirección de Entrega:</strong> <?php echo e($venta->direccion_entrega); ?></p>

        <!-- Productos del Pedido -->
        <h2 class="text-xl font-bold mt-8 mb-4">Productos del Pedido</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2 text-left">Producto</th>
                    <th class="border p-2 text-left">Cantidad</th>
                    <th class="border p-2 text-left">Tamaño</th>
                    <th class="border p-2 text-left">Dedicatoria</th>
                    <th class="border p-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $venta->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($detalle->producto): ?>
                        <tr>
                            <td class="border p-2"><?php echo e($detalle->producto->nombre); ?></td>
                            <td class="border p-2"><?php echo e($detalle->cantidad); ?></td>
                            <td class="border p-2"><?php echo e($detalle->tamaño ?? 'N/A'); ?></td>
                            <td class="border p-2"><?php echo e($detalle->dedicatoria ?? 'N/A'); ?></td>
                            <td class="border p-2">S/ <?php echo e(number_format($detalle->precio_unitario, 2)); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Servicios del Pedido -->
        <h2 class="text-xl font-bold mt-8 mb-4">Servicios del Pedido</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2 text-left">Servicio</th>
                    <th class="border p-2 text-left">Cantidad</th>
                    <th class="border p-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $venta->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($detalle->servicio): ?>
                        <tr>
                            <td class="border p-2"><?php echo e($detalle->servicio->nombre); ?></td>
                            <td class="border p-2"><?php echo e($detalle->cantidad); ?></td>
                            <td class="border p-2">S/ <?php echo e(number_format($detalle->precio_unitario, 2)); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Botón para regresar -->
        <a href="<?php echo e(route('admin.verPedidos')); ?>" class="block bg-blue-600 text-white text-center py-2 rounded mt-6 hover:bg-blue-700 transition-colors">
            Volver al Listado
        </a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/ventas-detalle.blade.php ENDPATH**/ ?>