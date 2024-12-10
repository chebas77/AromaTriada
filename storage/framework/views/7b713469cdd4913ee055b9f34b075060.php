<?php $__env->startSection('title', "Detalle del Tracking #{$tracking->id_tracking}"); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Detalle del Tracking #<?php echo e($tracking->id_tracking); ?></h1>
    
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl mx-auto">
        <!-- Información del Tracking -->
        <p class="mb-4"><strong>ID Venta:</strong> <?php echo e($tracking->id_venta); ?></p>
        <p class="mb-4"><strong>Estado:</strong> <?php echo e($tracking->estado_actual); ?></p>
        <p class="mb-4"><strong>Origen:</strong> <?php echo e($tracking->origen); ?></p>
        <p class="mb-4"><strong>Destino:</strong> <?php echo e($tracking->destino); ?></p>
        <p class="mb-4"><strong>Fecha de Despacho:</strong> <?php echo e($tracking->fecha_despacho ?? 'Pendiente'); ?></p>
        <p class="mb-4"><strong>Fecha de Entrega:</strong> <?php echo e($tracking->fecha_entrega ?? 'Pendiente'); ?></p>
        <p class="mb-4"><strong>Hora Programada:</strong> <?php echo e($tracking->hora_programada ?? 'Pendiente'); ?></p>

        <!-- Productos Relacionados -->
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
                <?php $__currentLoopData = $tracking->venta->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($detalle->producto): ?>
                    <tr>
                        <td class="border p-2"><?php echo e($detalle->producto->nombre); ?></td>
                        <td class="border p-2"><?php echo e($detalle->cantidad); ?></td>
                        <td class="border p-2"><?php echo e($detalle->tamaño ?? 'Sin tamaño'); ?></td>
                        <td class="border p-2"><?php echo e($detalle->dedicatoria ?? 'Sin dedicatoria'); ?></td>
                        <td class="border p-2"><?php echo e(number_format($detalle->precio_unitario, 2)); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Servicios Relacionados -->
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
                <?php $__currentLoopData = $tracking->venta->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($detalle->servicio): ?>
                    <tr>
                        <td class="border p-2"><?php echo e($detalle->servicio->nombre); ?></td>
                        <td class="border p-2"><?php echo e($detalle->cantidad); ?></td>

                        <td class="border p-2"><?php echo e(number_format($detalle->precio_unitario, 2)); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <a href="<?php echo e(route('admin.tracking.index')); ?>" 
           class="block bg-blue-600 text-white text-center py-2 rounded mt-6 hover:bg-blue-700 transition-colors">
           Volver al Listado
        </a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/tracking/detalle.blade.php ENDPATH**/ ?>