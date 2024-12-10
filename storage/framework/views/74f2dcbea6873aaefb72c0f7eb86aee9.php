<?php $__env->startSection('title', 'Editar Usuario'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>

    
    <form action="<?php echo e(route('admin.actualizarUsuario', $usuario->id)); ?>" method="POST" class="bg-white rounded-lg shadow-md p-6 space-y-4 max-w-lg mx-auto">
        <?php echo csrf_field(); ?> 
        
        
        <!-- Campo para el nombre -->
        <div>
            <label for="name" class="block text-gray-700 font-bold mb-2">Nombre:</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name', $usuario->name)); ?>" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Campo para el correo electrónico -->
        <div>
            <label for="email" class="block text-gray-700 font-bold mb-2">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="<?php echo e(old('email', $usuario->email)); ?>" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Campo para el rol -->
        <div>
            <label for="id_rol" class="block text-gray-700 font-bold mb-2">Rol:</label>
            <select name="id_rol" id="id_rol" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($rol->id_rol); ?>" <?php echo e(old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : ''); ?>>
                        <?php echo e($rol->nombre); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['id_rol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <!-- Campo para el teléfono -->
<div>
    <label for="telefono" class="block text-gray-700 font-bold mb-2">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo e(old('telefono', $usuario->telefono)); ?>" 
           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
           minlength="9" maxlength="12" 
           placeholder="Ingrese su número de teléfono">
    <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


        <!-- Botón para guardar cambios -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>


<div class="mt-6 text-center">
    <a href="<?php echo e(route('admin.gestionarUsuarios')); ?>" 
       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
        Regresar
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/usuarios-edit.blade.php ENDPATH**/ ?>