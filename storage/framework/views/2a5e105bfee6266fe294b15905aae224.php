<?php $__env->startSection('title', 'Estado de tu Envío'); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-6">
    <h1 class="text-4xl font-bold mb-12 text-center text-gray-800">Estado de tu Envío</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php $__currentLoopData = $tracking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300 transform hover:scale-105">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Envío #<?php echo e($item->id_tracking); ?></h3>
            <p class="text-sm text-gray-600"><strong>Origen:</strong> <?php echo e($item->origen); ?></p>
            <p class="text-sm text-gray-600"><strong>Destino:</strong> <?php echo e($item->destino); ?></p>
            <p class="text-sm text-gray-600"><strong>Estado Actual:</strong> <?php echo e($item->estado_actual); ?></p>
            <p class="text-sm text-gray-600"><strong>Fecha de Despacho:</strong> <?php echo e($item->fecha_despacho ?? 'Pendiente'); ?></p>
            <p class="text-sm text-gray-600"><strong>Fecha de Entrega:</strong> <?php echo e($item->fecha_entrega ? $item->fecha_entrega->format('Y-m-d') : 'Pendiente'); ?></p>
            <p class="text-sm text-gray-600"><strong>Hora Programada:</strong> <?php echo e($item->hora_programada ?? 'Pendiente'); ?></p>
            <a href="<?php echo e(route('tracking.detalle', $item->id_tracking)); ?>" 
   class="block mt-6 text-center text-white bg-red-500 px-6 py-2 rounded-lg hover:bg-dorado transition-all duration-300">
   Ver Detalles
</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/tracking.blade.php ENDPATH**/ ?>