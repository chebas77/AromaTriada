@extends('recursos.app')
  @section('title', 'Index')

  @section('content')

  <section class="bg-crema1 py-16">
    <div class="container mx-auto flex flex-col md:flex-row items-center">
        <!-- Lado izquierdo: Imagen -->
        <div class="md:w-1/2">
            <img src="{{ asset('images/fondo.jpg') }}" alt="Portada" class="w-full rounded-lg shadow-md">
        </div>

        <!-- Lado derecho: Texto y botón -->
        <div class="md:w-1/2 mt-8 md:mt-0 md:pl-12 text-center md:text-left">
            <!-- Personalización del mensaje de bienvenida -->
            @if(auth()->check())
                @if(auth()->user()->esAdministrador())
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenido a Aroma Triada Administrador</h1>
                @else
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenido a Aroma Triada {{ auth()->user()->name }}</h1>
                @endif
            @else
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenido a Aroma Triada</h1>
            @endif
            
            <p class="text-lg text-gray-600 mb-6">
                Descubre nuestras deliciosas opciones diseñadas para momentos especiales. Déjanos ser parte de tus celebraciones con un toque único.
            </p>
            <a href="https://wa.me/51990751294?text=¡Hola!%20Estoy%20interesado%20en%20hacer%20un%20pedido" class="bg-violeta text-white py-3 px-6 rounded-lg shadow-md hover:bg-gray-800 transition-all duration-300" target="_blank">
                Pedidos Personalizados
            </a>
        </div>
    </div>
</section>

<!-- Featured Collection Carousel -->
<section class="container mx-auto py-12 px-6 text-center">
  <h2 class="text-3xl font-bold mb-6 font-fascinate">COLECCIÓN DESTACADA</h2>

  <!-- Swiper -->
  <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    @foreach ($productosDestacados as $producto)
    <div class="swiper-slide relative bg-white shadow-lg p-6 rounded-lg group border-2 border-gray-200 hover:border-violeta hover:shadow-2xl transition-all duration-300" 
    onmouseover="swiperInstance.autoplay.stop()" onmouseleave="swiperInstance.autoplay.start()">  <!-- STOP DE CARRUSEL -->
      <!-- Imagen del producto -->
      <div class="relative overflow-hidden rounded-lg">
        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-40 w-full object-cover mb-4 rounded-lg transition-transform duration-300 group-hover:scale-110">
      </div>

      <!-- Información del producto -->
      <h3 class="text-lg font-bold text-gray-800 group-hover:text-violeta transition-colors duration-300">
        {{ $producto->nombre }}
      </h3>
      <p class="text-gray-600 text-sm mb-4">Edición limitada</p>

      <!-- Botón -->
      <a href="{{ route('detalle.item', ['tipo' => 'producto', 'id' => $producto->id_producto]) }}" class="bg-violeta text-white py-2 px-6 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 hover:from-pink-500 hover:to-purple-500">
        Comprar
      </a>
    </div>
    @endforeach
  </div><br><br>
  <div class="swiper-pagination"></div>
</div>
</section>

<!-- Swiper Initialization -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Crear una instancia global de Swiper
    const swiperInstance = new Swiper('.mySwiper', {
      slidesPerView: 4, // Número de productos visibles
      spaceBetween: 40, // Espaciado entre los productos
      loop: true, // Carrusel infinito
      autoplay: {
        delay: 2000, // Tiempo entre cada deslizamiento
        disableOnInteraction: false, // No desactivar al interactuar
      },
      pagination: {
        el: '.swiper-pagination', // Los puntos de navegación
        clickable: true, // Hacer los puntos clickeables
      },
      breakpoints: {
        640: {
          slidesPerView: 1, // En pantallas pequeñas, muestra solo 1 producto
          spaceBetween: 10, // Menor espacio entre los productos
        },
        768: {
          slidesPerView: 2, // En pantallas medianas, muestra 2 productos
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 5, // En pantallas grandes, muestra 5 productos
          spaceBetween: 40,
        }
      }
    });

    // Accesibilidad global de la instancia swiper
    window.swiperInstance = swiperInstance;
  });
</script>


 <!-- PRINCIPALES CATEGPRIAS -->
 <section class="container mx-auto py-12 px-8 text-center">
  <h2 class="text-3xl font-bold mb-6 font-fascinate">PRINCIPALES CATEGORÍAS</h2>

  <!-- Static Categories -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Category 1: TORTAS -->
    <a href="{{ route('aroma.catalogo', ['categorias' => [1]]) }}" class="relative group bg-violeta shadow rounded overflow-hidden">
      <img src="{{ asset('images/1.jpg') }}" alt="TORTAS" class="w-full h-76 object-cover group-hover:opacity-80 transition duration-300">
      <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-40 transition duration-300">
        <span class="text-white font-bold text-lg">VER PRODUCTOS</span>
      </div>
      <div class="p-4">
        <h3 class="text-lg font-bold uppercase text-white">TORTAS</h3>
      </div>
    </a>

    <!-- Category 2: BOCADITOS -->
    <a href="{{ route('aroma.catalogo', ['categorias' => [2]]) }}" class="relative group bg-violeta shadow rounded overflow-hidden">
      <img src="{{ asset('images/2.jpg') }}" alt="BOCADITOS" class="w-full h-76 object-cover group-hover:opacity-80 transition duration-300">
      <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-40 transition duration-300">
        <span class="text-white font-bold text-lg">VER PRODUCTOS</span>
      </div>
      <div class="p-4">
        <h3 class="text-lg font-bold uppercase text-white">BOCADITOS</h3>
      </div>
    </a>

    <!-- Category 3: BOXES -->
    <a href="{{ route('aroma.catalogo', ['categorias' => [3]]) }}" class="relative group bg-violeta shadow rounded overflow-hidden">
      <img src="{{ asset('images/3.jpg') }}" alt="BOXES" class="w-full h-76 object-cover group-hover:opacity-80 transition duration-300">
      <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 opacity-0 group-hover:opacity-40 transition duration-300">
        <span class="text-white font-bold text-lg">VER PRODUCTOS</span>
      </div>
      <div class="p-4">
        <h3 class="text-lg font-bold uppercase text-white">BOXES</h3>
      </div>
    </a>
  </div>

  <!-- BOTON DE VER CATALOGO -->
  <div class="mt-8">
    <a href="/catalogo" class="bg-violeta text-white py-2 px-6 rounded text-lg font-bold hover:bg-gray-800">
      VER CATÁLOGO
    </a>
  </div>
</section>

  <!-- PORQUE NOSOTROS -->
  <section class="bg-cover bg-center py-16 text-center relative" style="background-image: url('{{ asset('images/fondo2.png') }}'); background-size: cover; background-position: center;">
  <!-- Difuminado de fondo -->
  <div class="bg-black absolute inset-0 opacity-50"></div>

  <!-- Contenido principal -->
  <div class="relative z-10 max-w-4xl mx-auto">
    <h3 class="text-3xl font-bold mb-8 text-white">¿POR QUÉ NOSOTROS?</h3>
    <p class="text-lg text-white mb-6 font-bold">
      Somos una <span class="font-bold">marca familiar</span> fundada en el amor por la tradición y el deseo de compartir momentos especiales. Cada pedido que recibimos es tratado con el mismo cariño y dedicación que ponemos en los productos que preparamos para nuestros propios seres queridos.
    </p>
    <p class="text-lg text-white mb-6 font-bold">
      Creemos que los <span class="font-bold">pequeños detalles marcan la diferencia</span>. En cada producto añadimos ese toque especial que hace que se sienta único, auténtico y lleno de calidez. Nos encanta saber que, al recibir nuestros productos, sientes el cuidado y el esfuerzo que ponemos en cada receta, como si lo hubieras preparado tú mismo en casa.
    </p>
    <p class="text-lg text-white mb-6 font-bold">
      Desde nuestra familia para la tuya, con la promesa de que cada bocado esté lleno de <span class="font-semibold">sabor, frescura</span> y, sobre todo, de un toque personal que hace que nuestras creaciones se sientan genuinas y auténticas.
    </p><br>
    <a href="{{ route('aroma.nosotros') }}" class="bg-violeta text-white px-6 py-2 font-bold rounded hover:bg-gray-800">
      VER MÁS
    </a>
  </div>
</section>


  <!-- GALERIA DE FOTOS -->
  <section class="bg-crema1 py-16">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 font-fascinate">Galería de Fotos</h2>
        
        <!-- Collage -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Imagen grande -->
            <div class="relative group overflow-hidden">
                <img src="{{ asset('images/galeria2.jpg') }}" alt="Foto 1" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
            </div>

            <!-- Dos imágenes verticales -->
            <div class="grid grid-rows-2 gap-4">
                <div class="relative group overflow-hidden">
                    <img src="{{ asset('images/galeria4.jpg') }}" alt="Foto 2" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
                </div>
                <div class="relative group overflow-hidden">
                    <img src="{{ asset('images/galeria1.jpg') }}" alt="Foto 3" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
                </div>
            </div>

            <!-- Imagen mediana -->
            <div class="relative group overflow-hidden">
                <img src="{{ asset('images/galeria6.jpg') }}" alt="Foto 4" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
            </div>

            <!-- Dos imágenes horizontales -->
            <div class="grid grid-cols-2 gap-4">
                <div class="relative group overflow-hidden">
                    <img src="{{ asset('images/galeria9.jpg') }}" alt="Foto 5" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
                </div>
                <div class="relative group overflow-hidden">
                    <img src="{{ asset('images/galeria10.jpg') }}" alt="Foto 6" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
                </div>
            </div>

            <!-- Imagen grande al final -->
            <div class="relative group overflow-hidden">
                <img src="{{ asset('images/galeria3.jpg') }}" alt="Foto 7" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
            </div>

            <!-- Dos imágenes horizontales -->
            <div class="grid grid-cols-2 gap-4">
                <div class="relative group overflow-hidden">
                    <img src="{{ asset('images/galeria7.jpg') }}" alt="Foto 5" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
                </div>
                <div class="relative group overflow-hidden">
                    <img src="{{ asset('images/galeria8.jpg') }}" alt="Foto 6" class="w-full h-full object-cover rounded shadow-md transition-transform duration-300 group-hover:scale-110">
                </div>
            </div>
        </div>
    </div>
</section>
  @endsection