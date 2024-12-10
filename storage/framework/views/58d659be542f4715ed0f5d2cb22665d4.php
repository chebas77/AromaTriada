<?php $__env->startSection('title', 'Gestión de Usuarios'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios</h1>

    <!-- Filtro por nombre y fecha -->
    <form action="<?php echo e(route('admin.gestionarUsuarios')); ?>" method="GET" class="mb-6">
        <div class="flex space-x-4">
            <!-- Filtro por nombre -->
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="Buscar por nombre de usuario"
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            <!-- Filtro por fecha de inicio -->
            <input
                type="date"
                name="fecha_inicio"
                value="<?php echo e(request('fecha_inicio')); ?>"
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            <!-- Filtro por fecha de fin -->
            <input
                type="date"
                name="fecha_fin"
                value="<?php echo e(request('fecha_fin')); ?>"
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            <!-- Botón de búsqueda -->
            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                Buscar
            </button>
            <!-- Botón para restablecer filtros -->
            <a
                href="<?php echo e(route('admin.gestionarUsuarios')); ?>"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 focus:outline-none">
                Restablecer
            </a>
        </div>
    </form>

    <!-- Tabla de usuarios -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Correo Electrónico</th>
                    <th class="px-4 py-2 border">Fecha de Logeo</th>
                    <th class="px-4 py-2 border">Rol</th>
                    <th class="px-4 py-2 border">Teléfono</th>
                    <th class="px-4 py-2 border">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border"><?php echo e($usuario->name); ?></td>
                    <td class="px-4 py-2 border"><?php echo e($usuario->email); ?></td>
                    <td class="px-4 py-2 border"><?php echo e($usuario->created_at ? $usuario->created_at->format('Y-m-d') : 'Sin Fecha'); ?></td>
                    <td class="px-4 py-2 border"><?php echo e($usuario->rol->nombre ?? 'Sin Rol'); ?></td>
                    <td class="px-4 py-2 border"><?php echo e($usuario->telefono ?? 'No registrado'); ?></td>
                    <td class="px-4 py-2 border">
                        <a href="<?php echo e(route('admin.editarUsuario', $usuario->id)); ?>"
                            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                            Editar
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-4">No se encontraron usuarios.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/usuarios-index.blade.php ENDPATH**/ ?>