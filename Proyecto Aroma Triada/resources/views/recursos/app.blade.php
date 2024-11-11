<!-- recursos/app.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Sitio')</title>
    @vite('resources/css/app.css') <!-- Asegúrate de tener esta línea para cargar los estilos -->
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Header -->
    @include('recursos.header') <!-- Esto incluye el archivo header.blade.php -->

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content') <!-- Aquí se insertará el contenido específico de cada vista -->
    </main>

    <!-- Footer -->
    @include('recursos.footer') <!-- Esto incluye el archivo footer.blade.php -->

</body>

</html>