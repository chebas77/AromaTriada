<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col fixed h-screen">
        <div class="p-4 text-center">
            <h1 class="text-2xl font-bold">ADMIN AROMA TRIADA</h1>
        </div>
        <nav class="flex-1 px-4 space-y-4">
    <a href="{{ route('admin.index') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
        Dashboard
    </a>
    <a href="{{ route('admin.gestionarProductos') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
        Gestionar Productos
    </a>
    <a href="{{ route('admin.gestionarServicios') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
        Gestionar Servicios
    </a>
    <a href="{{ route('admin.gestionarUsuarios') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
        Gestionar Usuarios
    </a>
    <a href="{{ route('admin.verPedidos') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
        Gestionar Ventas/Pedidos
    </a>
    <a href="{{ route('admin.tracking.index') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
        Gestionar Tracking
    </a>
</nav>
        <div class="p-4">
            <a href="{{ route('aroma.index') }}" class="block bg-gray-600 hover:bg-gray-500 text-center text-white py-2 rounded">
                Regresar
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 flex-1 flex flex-col">
        @include('recursos.header_admin')

        <main class="flex-1 p-6">
            @yield('content')
        </main>

        @include('recursos.footer_admin')
    </div>

</body>
</html>
