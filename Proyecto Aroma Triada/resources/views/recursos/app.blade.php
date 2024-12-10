<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Sitio')</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">

    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Estilos de Vite -->
    @vite('resources/css/app.css')

     <!-- Font Awesome -->
     
     <!-- Font Awesome -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
</head>
  <!-- COLOR DE FONDO DE LA PAGINA -->
<body class="bg-crema3 flex flex-col min-h-screen">
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

<!-- Pantalla de Carga -->
<div id="loadingScreen" class="fixed top-0 left-0 w-full h-full bg-gradient-to-r from-violeta to-violeta-800 flex items-center justify-center z-50">
    <div class="flex flex-col items-center space-y-4">
        <!-- Texto estilizado como Logo -->
        <h1 class="text-white text-4xl font-fascinate animate-pulse">
            Aroma Triada
        </h1>

        <!-- Texto de carga -->
        <p class="text-white text-lg font-semibold"></p>

        <!-- Animación de puntos (opcional) -->
        <div class="flex space-x-2">
            <div class="w-4 h-4 bg-white rounded-full animate-bounce"></div>
            <div class="w-4 h-4 bg-white rounded-full animate-bounce delay-200"></div>
            <div class="w-4 h-4 bg-white rounded-full animate-bounce delay-400"></div>
        </div>
    </div>
</div>




    <script>
  window.addEventListener("load", function() {
    const loadingScreen = document.getElementById("loadingScreen");
    loadingScreen.style.transition = "opacity 0.5s ease-out";
    loadingScreen.style.opacity = 0;
    setTimeout(function() {
      loadingScreen.style.display = "none";
    }, 500); // Espera a que termine la transición
  });
</script>


</body>

</html>
