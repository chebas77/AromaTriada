<?php $__env->startSection('title', 'Editar Producto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Producto</h1>

    
    <form action="<?php echo e(route('admin.actualizarProducto', $producto->id_producto)); ?>" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Nombre -->
        <div>
            <label for="nombre" class="block text-gray-700 font-bold">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre', $producto->nombre)); ?>" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Descripción -->
        <div>
            <label for="descripcion" class="block text-gray-700 font-bold">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"><?php echo e(old('descripcion', $producto->descripcion)); ?></textarea>
            <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Precio -->
        <div>
            <label for="precio" class="block text-gray-700 font-bold">Precio</label>
            <input type="number" id="precio" name="precio" value="<?php echo e(old('precio', $producto->precio)); ?>" required step="0.01"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <?php $__errorArgs = ['precio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Stock -->
        <div>
            <label for="stock" class="block text-gray-700 font-bold">Stock</label>
            <input type="number" id="stock" name="stock" value="<?php echo e(old('stock', $producto->stock)); ?>" required min="0"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>


        <!-- Imagen -->
        <div>
            <label for="imagen" class="block text-gray-700 font-bold">Imagen</label>
            <?php if($producto->imagen): ?>
            <div class="mb-4">
                <img src="<?php echo e(asset($producto->imagen)); ?>" alt="Imagen del producto" class="w-32 h-32 object-cover rounded">
                <p class="text-sm text-gray-600 mt-2">Imagen actual</p>
            </div>
            <?php endif; ?>
            <input type="file" id="imagen" name="imagen" accept="image/*"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <p class="text-sm text-gray-600 mt-2">Sube una nueva imagen para reemplazar la existente</p>
            <?php $__errorArgs = ['imagen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Categoría -->
        <div>
            <label for="id_categoria" class="block text-gray-700 font-bold">Categoría</label>
            <select id="id_categoria" name="id_categoria" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="cosito">Seleccione una categoría</option> <!-- Opción predeterminada vacía -->
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($categoria->id); ?>"
                    <?php echo e(old('id_categoria', $producto->id_categoria) == $categoria->id ? 'selected' : ''); ?>>
                    <?php echo e($categoria->nombre); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['id_categoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Botones -->
        <div class="flex space-x-4">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Actualizar Producto
            </button>
            <a href="<?php echo e(route('admin.gestionarProductos')); ?>" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/productos-edit.blade.php ENDPATH**/ ?>