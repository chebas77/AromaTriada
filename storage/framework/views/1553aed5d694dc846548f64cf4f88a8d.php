<div class="bg-gray-100 flex flex-col">
    <!-- Header -->
    <header class="bg-white text-black w-full">
        <!-- Banner de promociones -->
        <div class="bg-black text-white text-center py-2 text-xs">
            APROVECHA LOS NUEVOS LANZAMIENTOS POR ÉPOCAS NAVIDEÑAS!!
        </div>
        
        <!-- Barra de navegación -->
        <nav class="w-full flex items-center justify-between py-2 px-12">
            <!-- Logo centrado -->
            <div class="flex-1 flex justify-center">
                <a href="<?php echo e(route('aroma.index')); ?>">
                    <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Logo Aroma Triada" class="h-20 ml-8">
                </a>
            </div>

            <!-- Enlaces de usuario -->
            <div class="flex items-center space-x-6">
                <!-- Icono del carrito y perfil -->
                <a href="<?php echo e(route('carrito.mostrar')); ?>" class="hover:underline"><i class="fa-solid fa-cart-shopping text-2xl"></i></a>
                <a href="<?php echo e(route('aroma.perfil')); ?>" class="hover:underline"><i class="fa-solid fa-user text-2xl"></i></a>
            </div>
        </nav>

        <!-- Menú de navegación debajo del logo -->
        <div class="bg-beige py-2">
            <div class="flex justify-center">
                <ul class="flex space-x-8">
                    <li><a href="<?php echo e(route('aroma.index')); ?>" class="hover:underline">INICIO</a></li>
                    <li><a href="<?php echo e(route('aroma.nosotros')); ?>" class="hover:underline">NOSOTROS</a></li>
                    <li><a href="<?php echo e(route('aroma.preguntas')); ?>" class="hover:underline">PREGUNTAS</a></li>
                    <li><a href="<?php echo e(route('aroma.catalogo')); ?>" class="hover:underline">CATÁLOGO</a></li>
                </ul>
            </div>
        </div>

        <!-- Sección de inicio de sesión / registrarse -->
        <div class="bg-beige w-full py-2 px-12 text-sm text-black text-right">
            <?php if(auth()->check()): ?>
                <?php if(auth()->user()->esAdministrador()): ?>
                    <a href="<?php echo e(route('admin.index')); ?>" class="hover:underline text-black">Panel de Administración</a> |
                <?php endif; ?>
                <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="hover:underline text-black">Cerrar Sesión</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('aroma.inicioSesion')); ?>" class="hover:underline text-black">Iniciar Sesión |</a>
                <a href="<?php echo e(route('aroma.registro')); ?>" class="hover:underline text-black">Registrarse</a>
            <?php endif; ?>
        </div>
    </header>
</div>
<?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/recursos/header.blade.php ENDPATH**/ ?>