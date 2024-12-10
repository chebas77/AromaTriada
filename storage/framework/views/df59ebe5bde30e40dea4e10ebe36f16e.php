<header class="bg-white shadow py-4 px-6">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">Panel de Administración</h1>
        <div class="flex items-center space-x-4">
            <span class="text-gray-600"><?php echo e(Auth::user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</header>
<?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/recursos/header_admin.blade.php ENDPATH**/ ?>