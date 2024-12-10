<?php $__env->startSection('title', 'Gestionar Tracking'); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Gestionar Tracking</h1>
    
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl mx-auto">
        <p class="mb-4"><strong>ID Pedido:</strong> <?php echo e($tracking->id_venta); ?></p>
        <p class="mb-4"><strong>Estado Actual:</strong> <?php echo e($tracking->estado_actual); ?></p>
        <p class="mb-4"><strong>Origen:</strong> <?php echo e($tracking->origen); ?></p>
        <p class="mb-4"><strong>Destino:</strong> <?php echo e($tracking->destino); ?></p>
        <p class="mb-4"><strong>Fecha de Entrega:</strong> <?php echo e($tracking->fecha_entrega ?? 'Pendiente'); ?></p>
        <p class="mb-4"><strong>Hora Programada:</strong> <?php echo e($tracking->hora_programada ?? 'Pendiente'); ?></p>

        <!-- Formulario para Actualizar Tracking -->
        <form action="<?php echo e(route('admin.tracking.actualizar', $tracking->id_tracking)); ?>" method="POST" class="mt-8">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Seleccionar Estado -->
            <div class="mb-4">
                <label for="estado_actual" class="block text-gray-700 font-bold mb-2">Nuevo Estado</label>
                <select name="estado_actual" id="estado_actual" class="w-full border rounded-lg px-4 py-2">
                    <option value="Preparando envío" <?php echo e($tracking->estado_actual == 'Preparando envío' ? 'selected' : ''); ?>>Preparando envío</option>
                    <option value="En proceso" <?php echo e($tracking->estado_actual == 'En proceso' ? 'selected' : ''); ?>>En proceso</option>
                    <option value="Enviado" <?php echo e($tracking->estado_actual == 'Enviado' ? 'selected' : ''); ?>>Enviado</option>
                    <option value="Entregado" <?php echo e($tracking->estado_actual == 'Entregado' ? 'selected' : ''); ?>>Entregado</option>
                    <option value="Cancelado" <?php echo e($tracking->estado_actual == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
                </select>
            </div>

            <!-- Fecha de Despacho -->
            <div class="mb-4">
                <label for="fecha_despacho" class="block text-gray-700 font-bold mb-2">Fecha de Despacho</label>
                <input type="datetime-local" name="fecha_despacho" id="fecha_despacho" 
                       value="<?php echo e($tracking->fecha_despacho ? $tracking->fecha_despacho->format('Y-m-d\TH:i') : ''); ?>"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

            <!-- Botones -->
            <div class="flex justify-between">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    Actualizar Información
                </button>
                <a href="<?php echo e(route('admin.tracking.index')); ?>" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600">
                    Regresar
                </a>
            </div>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/tracking/show.blade.php ENDPATH**/ ?>