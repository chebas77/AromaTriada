<!-- recursos/auth.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Autenticación'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?> <!-- Asegúrate de tener esta línea para cargar los estilos -->
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Header Especializado para Autenticación -->
    <?php echo $__env->make('recursos.header_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Incluye header_auth.blade.php para autenticación -->

    <!-- Contenido Principal -->
    <main class="flex-grow flex items-center justify-center py-12 bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-xl rounded-lg p-8">
            <?php echo $__env->yieldContent('content'); ?> <!-- Aquí se insertará el contenido específico de cada vista -->
        </div>
    </main>

    <!-- Footer Especializado para Autenticación -->
    <?php echo $__env->make('recursos.footer_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Incluye footer_auth.blade.php para autenticación -->

</body>
</html>
<?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/recursos/auth.blade.php ENDPATH**/ ?>