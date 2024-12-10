<!-- recursos/auth.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Autenticación')</title>
    @vite('resources/css/app.css') <!-- Asegúrate de tener esta línea para cargar los estilos -->
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Header Especializado para Autenticación -->
    @include('recursos.header_auth') <!-- Incluye header_auth.blade.php para autenticación -->

    <!-- Contenido Principal -->
    <main class="flex-grow flex items-center justify-center">
        @yield('content') <!-- Aquí se insertará el contenido específico de cada vista -->
    </main>

    <!-- Footer Especializado para Autenticación -->
    @include('recursos.footer_auth') <!-- Incluye footer_auth.blade.php para autenticación -->

</body>
</html>
