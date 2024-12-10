<?php $__env->startSection('title', "Detalle del Envío #$tracking->id_tracking"); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Detalle del Envío #<?php echo e($tracking->id_tracking); ?></h1>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
        <!-- Información General -->
        <div class="mb-6">
            <p class="mb-2"><strong>Origen:</strong> <?php echo e($tracking->origen); ?></p>
            <p class="mb-2"><strong>Destino:</strong> <?php echo e($tracking->destino); ?></p>
            <p class="mb-2"><strong>Fecha de Despacho:</strong> <?php echo e($tracking->fecha_despacho ?? 'Pendiente'); ?></p>
            <p class="mb-2"><strong>Fecha de Entrega:</strong> <?php echo e($tracking->fecha_entrega ? $tracking->fecha_entrega->format('Y-m-d') : 'Pendiente'); ?></p>
            <p class="mb-2"><strong>Hora Programada:</strong> <?php echo e($tracking->hora_programada ?? 'Pendiente'); ?></p>
        </div>

        <div class="relative w-full h-2 bg-gray-200 rounded-full mb-8">
    <!-- Línea de progreso -->
    <div class="absolute top-0 h-2 bg-blue-500 rounded-full" style="width: <?php echo e($progressPercentage); ?>%; "></div>
    <!-- Puntos de progreso -->
    <div class="flex justify-between">
        <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="relative text-center">
                <!-- Punto de progreso -->
                <div class="w-6 h-6 rounded-full mx-auto 
                    <?php echo e($index <= array_search($tracking->estado_actual, $estados) ? 'bg-blue-500' : 'bg-gray-300'); ?>">
                </div>
                <!-- Etiqueta del estado -->
                <span class="text-xs mt-1 block 
                    <?php echo e($estado == $tracking->estado_actual ? 'font-bold text-blue-600' : 'text-gray-500'); ?>">
                    <?php echo e($estado); ?>

                </span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

        <!-- Productos del Pedido -->
        <h2 class="text-xl font-bold mt-8 mb-4">Productos del Pedido</h2>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">Producto</th>
                    <th class="border px-4 py-2 text-left">Cantidad</th>
                    <th class="border px-4 py-2 text-left">Tamaño</th>
                    <th class="border px-4 py-2 text-left">Dedicatoria</th>
                    <th class="border px-4 py-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2"><?php echo e($producto->producto->nombre); ?></td>
                    <td class="border px-4 py-2"><?php echo e($producto->cantidad); ?></td>
                    <td class="border px-4 py-2"><?php echo e($producto->tamaño ?? 'N/A'); ?></td>
                    <td class="border px-4 py-2"><?php echo e($producto->dedicatoria ?? 'Sin dedicatoria'); ?></td>
                    <td class="border px-4 py-2 text-right">$<?php echo e(number_format($producto->precio_unitario, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Servicios del Pedido -->
        <h2 class="text-xl font-bold mt-8 mb-4">Servicios del Pedido</h2>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">Servicio</th>
                    <th class="border px-4 py-2 text-left">Cantidad</th>
                    <th class="border px-4 py-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2"><?php echo e($servicio->servicio->nombre); ?></td>
                    <td class="border px-4 py-2"><?php echo e($servicio->cantidad); ?></td>
                    <td class="border px-4 py-2 text-right">$<?php echo e(number_format($servicio->precio_unitario, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Total del Pedido -->
        <div class="mt-6 text-right">
            <?php
                $totalProductos = $productos->sum(function ($producto) {
                    return $producto->cantidad * $producto->precio_unitario;
                });

                $totalServicios = $servicios->sum(function ($servicio) {
                    return $servicio->cantidad * $servicio->precio_unitario;
                });

                $totalPedido = $totalProductos + $totalServicios;
            ?>
            <h2 class="text-xl font-bold text-red-600">Total del Pedido: $<?php echo e(number_format($totalPedido, 2)); ?></h2>
        </div>

        <a href="<?php echo e(route('tracking.mostrar')); ?>" 
           class="block bg-blue-600 text-white text-center py-2 rounded mt-6 hover:bg-blue-700 transition">
           Volver al Listado
        </a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/tracking-detalle.blade.php ENDPATH**/ ?>