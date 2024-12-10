<!-- resources/views/auth/login.blade.php -->
 <!-- Extiende de la plantilla auth.blade.php, que tiene los headers y footers especializados -->

<?php $__env->startSection('title', 'Iniciar Sesión'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold text-center mb-8">Iniciar Sesión</h1>
<form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
    <?php echo csrf_field(); ?>

    <!-- Correo Electrónico -->
    <div>
        <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>"
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Ingresa tu correo electrónico" required autofocus>
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

    <!-- Contraseña -->
    <div>
        <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
        <input type="password" id="password" name="password"
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Ingresa tu contraseña" required>
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

    <!-- Olvidaste tu Contraseña -->
    <div class="flex justify-between items-center">
        <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-gray-500 hover:text-gray-700">¿Olvidaste tu contraseña?</a>
    </div>

    <!-- Botón de Inicio de Sesión -->
    <button type="submit" class="w-full bg-black text-white py-2 font-semibold rounded hover:bg-gray-800">Iniciar Sesión</button>
</form>

<p class="text-center text-gray-600 mt-6">
    ¿No tienes una cuenta?
    <a href="<?php echo e(route('aroma.registro')); ?>" class="text-blue-500 hover:underline">Regístrate aquí</a>
</p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/inicioSesion.blade.php ENDPATH**/ ?>