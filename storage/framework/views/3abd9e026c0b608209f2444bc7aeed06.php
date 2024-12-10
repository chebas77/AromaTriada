<?php $__env->startSection('title', 'Gestión de Productos'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-6 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Gestión de Productos</h1>

    <!-- Filtro por categoría y disponibilidad -->
    <form action="<?php echo e(route('admin.gestionarProductos')); ?>" method="GET" class="mb-8 flex gap-6 items-center flex-wrap">
        <div class="flex-1 min-w-[200px] max-w-xs">
            <label for="categoria" class="block text-gray-700 font-semibold mb-1">Filtrar por Categoría:</label>
            <select id="categoria" name="categoria" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas</option>
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($categoria->id_categoria); ?>" <?php echo e(request('categoria') == $categoria->id_categoria ? 'selected' : ''); ?>>
                    <?php echo e($categoria->nombre); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="flex-1 min-w-[200px] max-w-xs">
            <label for="disponibilidad" class="block text-gray-700 font-semibold mb-1">Filtrar por Disponibilidad:</label>
            <select id="disponibilidad" name="disponibilidad" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas</option>
                <option value="1" <?php echo e(request('disponibilidad') == '1' ? 'selected' : ''); ?>>Disponible</option>
                <option value="0" <?php echo e(request('disponibilidad') == '0' ? 'selected' : ''); ?>>No Disponible</option>
            </select>
        </div>

        <div class="flex-shrink-0 flex gap-4 justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Filtrar</button>
            <a href="<?php echo e(route('admin.gestionarProductos')); ?>" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-300">Restablecer</a>
        </div>
    </form>

    <!-- Tabla de productos -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <table class="w-full table-fixed border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm leading-normal">
                <th class="border px-4 py-3 w-20">Imagen</th>
                <th class="border px-4 py-3 w-40">Nombre</th>
                <th class="border px-4 py-3 w-40">Categoría</th>
                <th class="border px-4 py-3">Descripción</th>
                <th class="border px-4 py-3 w-24">Precio</th>
                <th class="border px-4 py-3 w-32 text-center">Disponibilidad</th>
                <th class="border px-4 py-3 w-24 text-center">Stock</th>
                <th class="border px-4 py-3 w-40 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm">
            <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="bg-white hover:bg-gray-50 transition duration-300">
                    <!-- Imagen -->
                    <td class="border px-4 py-2 text-center">
                        <?php if($producto->imagen): ?>
                            <img src="<?php echo e(asset($producto->imagen)); ?>" alt="<?php echo e($producto->nombre); ?>" class="h-12 w-12 object-cover rounded-md mx-auto">
                        <?php else: ?>
                            <span class="text-gray-500 italic">Sin imagen</span>
                        <?php endif; ?>
                    </td>
                    <!-- Nombre -->
                    <td class="border px-4 py-2 truncate"><?php echo e($producto->nombre); ?></td>
                    <!-- Categoría -->
                    <td class="border px-4 py-2 truncate"><?php echo e($producto->categoria->nombre ?? 'Sin Categoría'); ?></td>
                    <!-- Descripción -->
                    <td class="border px-4 py-2 truncate"><?php echo e($producto->descripcion); ?></td>
                    <!-- Precio -->
                    <td class="border px-4 py-2 text-right">S/<?php echo e(number_format($producto->precio, 2)); ?></td>
                    <!-- Disponibilidad -->
                    <td class="border px-4 py-2 text-center">
                        <form action="<?php echo e(route('admin.actualizarDisponibilidad', $producto)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <label class="inline-flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" name="disponibilidad" onchange="this.form.submit()" class="hidden" <?php echo e($producto->disponibilidad ? 'checked' : ''); ?> />
                                    <div class="w-12 h-6 rounded-full transition-colors duration-300 ease-in-out 
                                        <?php echo e($producto->disponibilidad ? 'bg-green-500' : 'bg-red-500'); ?>"></div>
                                    <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300 
                                        <?php echo e($producto->disponibilidad ? 'transform translate-x-6' : 'transform translate-x-0'); ?>"></div>
                                </div>
                            </label>
                        </form>
                    </td>
                    <!-- Stock -->
                    <td class="border px-4 py-2 text-center"><?php echo e($producto->stock); ?></td>
                    <!-- Acciones -->
                    <td class="border px-4 py-2 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="<?php echo e(route('admin.editarProducto', $producto)); ?>" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-400 transition duration-300">Editar</a>
                            <form action="<?php echo e(route('admin.eliminarProducto', $producto)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-400 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition duration-300">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500 italic">No se encontraron productos.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


    <!-- Paginación con appends para mantener los filtros -->
    <?php if($productos instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
    <div class="mt-6">
        <?php echo e($productos->appends([
            'categoria' => request('categoria'),
            'disponibilidad' => request('disponibilidad')
        ])->links()); ?>

    </div>
    <?php endif; ?>
</div>

<!-- Botón para crear un nuevo producto -->
<a href="<?php echo e(route('admin.crearProducto')); ?>" class="bg-blue-500 text-white px-6 py-3 rounded-lg mt-8 inline-block">Crear Producto</a>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/productos-index.blade.php ENDPATH**/ ?>