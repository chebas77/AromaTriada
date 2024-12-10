<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Panel de Administración'); ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-gray-800 text-white flex flex-col fixed h-screen transform -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="p-4 text-center">
        <a href="<?php echo e(route('aroma.index')); ?>" class="text-2xl font-bold">ADMIN AROMA TRIADA</a>
    </div>
    <nav class="flex-1 px-4 space-y-4">
        <a href="<?php echo e(route('admin.index')); ?>" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
            Dashboard
        </a>
        <a href="<?php echo e(route('admin.gestionarProductos')); ?>" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
            Gestionar Productos
        </a>
        <a href="<?php echo e(route('admin.gestionarServicios')); ?>" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
            Gestionar Servicios
        </a>
        <a href="<?php echo e(route('admin.gestionarUsuarios')); ?>" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
            Gestionar Usuarios
        </a>
        <a href="<?php echo e(route('admin.verPedidos')); ?>" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
            Gestionar Ventas/Pedidos
        </a>
        <a href="<?php echo e(route('admin.tracking.index')); ?>" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
            Gestionar Tracking
        </a>
    </nav>
    <div class="p-4">
        <a href="<?php echo e(route('aroma.index')); ?>" class="block bg-gray-600 hover:bg-gray-500 text-center text-white py-2 rounded">
            Regresar
        </a>
    </div>
</aside>

<!-- Main Content -->
<div id="content" class="transition-all duration-300 ease-in-out ml-0">
    <?php echo $__env->make('recursos.header_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="flex-1 p-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('recursos.footer_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

    <!-- JavaScript para mostrar/ocultar el sidebar -->
    <script>
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    let isSidebarOpen = true; // El sidebar estará visible por defecto.

    // Mostrar siempre el sidebar al cargar o cambiar de vista
    window.addEventListener('DOMContentLoaded', () => {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        content.classList.add('ml-64');
        content.classList.remove('ml-0');
        isSidebarOpen = true; // Asegura que esté visible al cargar
    });

    // Mostrar el sidebar al pasar el mouse cerca del borde izquierdo
    content.addEventListener('mousemove', (e) => {
        if (!isSidebarOpen && e.clientX <= 50) { // Si el mouse está cerca del borde izquierdo
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            content.classList.add('ml-64');
            content.classList.remove('ml-0');
        }
    });

    // Fijar el sidebar al hacer clic en él (se mantiene visible)
    sidebar.addEventListener('click', (e) => {
        e.stopPropagation(); // Evita que el clic en el sidebar lo cierre
        isSidebarOpen = true; // Asegura que el sidebar quede fijado
    });

    // Ocultar el sidebar al hacer clic en la parte blanca
    document.addEventListener('click', (e) => {
        if (isSidebarOpen && !sidebar.contains(e.target)) { // Si el clic no ocurre dentro del sidebar
            isSidebarOpen = false; // Cambia el estado del sidebar
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            content.classList.add('ml-0');
            content.classList.remove('ml-64');
        }
    });
</script>



</body>
</html>
<?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/recursos/base_admin.blade.php ENDPATH**/ ?>