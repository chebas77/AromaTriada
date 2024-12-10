 <!-- Extiende de la plantilla base para autenticación -->

<?php $__env->startSection('title', 'Registro de Usuario'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-center bg-cover bg-center w-full relative" style="background-image: url('<?php echo e(asset('images/fondo2.png')); ?>'); min-height: 86vh;">
    <!-- Capa con opacidad sobre el fondo -->
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="w-full max-w-lg bg-violeta p-10 rounded-xl shadow-2xl z-10">
        <h1 class="text-4xl font-extrabold text-center text-crema3 mb-8">Crear una Cuenta</h1>
        <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-crema3 font-semibold mb-2">Nombre</label>
                <input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>" 
                       class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
                       placeholder="Nombre Completo" required autofocus>
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

            <!-- Correo Electrónico -->
            <div>
                <label for="email" class="block text-crema3 font-semibold mb-2">Correo Electrónico</label>
                <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" 
                       class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
                       placeholder="correo@example.com" required>
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

            <!-- Teléfono -->
            <div>
                <label for="telefono" class="block text-crema3 font-semibold mb-2">Teléfono</label>
                <input id="telefono" name="telefono" type="text" value="<?php echo e(old('telefono')); ?>" 
                       class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
                       placeholder="Número de Teléfono" required minlength="9" maxlength="12">
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

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-crema3 font-semibold mb-2">Contraseña</label>
                <input id="password" name="password" type="password" 
                       class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
                       placeholder="Contraseña" required>
                <?php $__errorArgs = ['password'];
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

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-crema3 font-semibold mb-2">Confirmar Contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" 
                       class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
                       placeholder="Confirmar Contraseña" required>
            </div>

            <!-- Botón de Registro -->
            <button type="submit" 
                    class="w-full bg-crema1 text-violeta py-3 font-semibold rounded-lg hover:bg-crema3 transition transform hover:scale-105 duration-300">
                Registrarse
            </button>
        </form>

        <p class="text-center text-crema3 mt-6">
            ¿Ya tienes una cuenta?
            <a href="<?php echo e(route('aroma.inicioSesion')); ?>" class="text-crema3 hover:underline">Inicia Sesión</a>
        </p>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/registro.blade.php ENDPATH**/ ?>