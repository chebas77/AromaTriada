<?php $__env->startSection('title', 'Gestión de Tracking'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Gestión de Tracking</h1>

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-6">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('admin.tracking.index')); ?>" method="GET" class="mb-6">
        <div class="flex space-x-4">
            <!-- Filtro por ID Tracking -->
            <input 
                type="text" 
                name="search" 
                value="<?php echo e(request('search')); ?>" 
                placeholder="Buscar por ID Tracking" 
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
            >
            
            <!-- Filtro por Estado -->
            <select 
                name="estado" 
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Filtrar por Estado</option>
                <option value="En proceso" <?php echo e(request('estado') == 'En proceso' ? 'selected' : ''); ?>>En proceso</option>
                <option value="Enviado" <?php echo e(request('estado') == 'Enviado' ? 'selected' : ''); ?>>Enviado</option>
                <option value="Entregado" <?php echo e(request('estado') == 'Entregado' ? 'selected' : ''); ?>>Entregado</option>
                <option value="Cancelado" <?php echo e(request('estado') == 'Cancelado' ? 'selected' : ''); ?>>Cancelado</option>
            </select>

            <!-- Botón de búsqueda -->
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                Buscar
            </button>
            
            <!-- Botón para restablecer filtros -->
            <a href="<?php echo e(route('admin.tracking.index')); ?>" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 focus:outline-none">
                Restablecer
            </a>
        </div>
    </form>

    
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">ID Tracking</th>
                    <th class="px-4 py-2 border">ID Venta</th>
                    <th class="px-4 py-2 border">Estado</th>
                    <th class="px-4 py-2 border">Origen</th>
                    <th class="px-4 py-2 border">Destino</th>
                    <th class="px-4 py-2 border">Fecha Despacho</th>
                    <th class="px-4 py-2 border">Fecha Entrega</th>
                    <th class="px-4 py-2 border">Hora programada</th>
                    <th class="px-4 py-2 border">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $trackings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Asignar clases dinámicas según el estado
                        $rowClass = match($tracking->estado_actual) {
                            'En proceso' => 'bg-yellow-100',
                            'Enviado' => 'bg-blue-100',
                            'Entregado' => 'bg-green-100',
                            'Cancelado' => 'bg-red-100',
                            default => '',
                        };
                    ?>
                    <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location='<?php echo e(route('admin.tracking.detalle', $tracking->id_tracking)); ?>'">
                        <td class="px-4 py-2 border"><?php echo e($tracking->id_tracking); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($tracking->id_venta); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($tracking->estado_actual); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($tracking->origen); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($tracking->destino); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($tracking->fecha_despacho ? $tracking->fecha_despacho->format('Y-m-d') : 'Pendiente'); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($tracking->fecha_entrega ? $tracking->fecha_entrega->format('Y-m-d'): 'Pendiente'); ?></td>
                        <td class="px-4 py-2 border"><?php echo e($tracking->hora_programada); ?></td>
                        <td class="px-4 py-2 border">
                            <a href="<?php echo e(route('admin.tracking.show', $tracking->id_tracking)); ?>" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Gestionar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-6">
        <?php echo e($trackings->appends(['search' => request('search'), 'estado' => request('estado')])->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/tracking/index.blade.php ENDPATH**/ ?>