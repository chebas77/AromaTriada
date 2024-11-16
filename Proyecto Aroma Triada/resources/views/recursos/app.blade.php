<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Sitio')</title>

    <!-- Estilos de Vite -->
    @vite('resources/css/app.css')

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Header -->
    @include('recursos.header')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content') <!-- Contenido dinámico de vistas hijas -->
    </main>

    <!-- Footer -->
    @include('recursos.footer')

    <!-- Scripts de Vite -->
    @vite('resources/js/app.js')
</body>

</html>
