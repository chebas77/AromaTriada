@extends('recursos.app')
  @section('title', 'Index')

  @section('content')

  <section class="bg-cover bg-center py-48 text-center" style="background-image: url({{ asset('images/navidadfondo.jpg') }}); background-size: cover; background-position: center;">
  <div class="flex justify-end px-6 py-16 w-full">
</section>

<!-- Featured Collection Carousel -->
<section class="container mx-auto py-12 px-6 text-center">
  <h2 class="text-2xl font-bold mb-6">COLECCIÓN DESTACADA</h2>

  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <!-- Product Cards in the carousel -->
      @foreach ($productosDestacados as $producto)
      <div class="swiper-slide bg-white shadow p-4 rounded relative group">
        <!-- Imagen del producto -->
        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-40 w-full object-cover mb-4 group-hover:opacity-40 transition duration-300">
        
        <!-- Información del producto -->
        <!--<h3 class="text-sm font-bold text-gray-500">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</h3>-->
        <p class="text-gray-800 mb-2 font-bold">{{ $producto->nombre }}</p>
        <!--<p class="text-gray-700 font-bold mb-4">S/{{ number_format($producto->precio, 2) }}</p>-->
        
        <!-- Botón de comprar que aparece con el hover -->
        <!-- Actualizando el enlace para redirigir al carrito -->
        <a href="{{ route('detalle.item', ['tipo' => 'producto', 'id' => $producto->id_producto]) }}" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-red-600 text-white py-2 px-6 rounded opacity-0 group-hover:opacity-100 transition-all duration-500 ease-out group-hover:translate-y-0 group-hover:scale-100 group-hover:translate-y-10">
          Comprar
        </a>
      </div>
      @endforeach
    </div>

    <!-- Paginación -->
     <br><br>
    <div class="swiper-pagination"></div>
  </div>
</section>

  <!-- Swiper Initialization -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.mySwiper', {
      slidesPerView:4, // Número de productos visibles
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
          slidesPerView: 5, // En pantallas grandes, muestra 4 productos
          spaceBetween: 40,
        }
      }
    });
  });
</script>

 <!-- PRINCIPALES CATEGPRIAS -->
 <section class="container mx-auto py-12 px-8 text-center">
  <h2 class="text-2xl font-bold mb-6">PRINCIPALES CATEGORÍAS</h2>

  <!-- Static Categories -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Category 1: TORTAS -->
    <a href="{{ route('aroma.catalogo', ['categorias' => [1]]) }}" class="relative group bg-white shadow rounded overflow-hidden">
      <img src="{{ asset('images/1.jpg') }}" alt="TORTAS" class="w-full h-96 object-cover group-hover:opacity-80 transition duration-300">
      <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-40 transition duration-300">
        <span class="text-white font-bold text-lg">Ver los productos</span>
      </div>
      <div class="p-4">
        <h3 class="text-lg font-bold uppercase">TORTAS</h3>
      </div>
    </a>

    <!-- Category 2: BOCADITOS -->
    <a href="{{ route('aroma.catalogo', ['categorias' => [2]]) }}" class="relative group bg-white shadow rounded overflow-hidden">
      <img src="{{ asset('images/2.jpg') }}" alt="BOCADITOS" class="w-full h-96 object-cover group-hover:opacity-80 transition duration-300">
      <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-40 transition duration-300">
        <span class="text-white font-bold text-lg">Ver los productos</span>
      </div>
      <div class="p-4">
        <h3 class="text-lg font-bold uppercase">BOCADITOS</h3>
      </div>
    </a>

    <!-- Category 3: BOXES -->
    <a href="{{ route('aroma.catalogo', ['categorias' => [3]]) }}" class="relative group bg-white shadow rounded overflow-hidden">
      <img src="{{ asset('images/3.jpg') }}" alt="BOXES" class="w-full h-96 object-cover group-hover:opacity-80 transition duration-300">
      <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 opacity-0 group-hover:opacity-40 transition duration-300">
        <span class="text-white font-bold text-lg">Ver los productos</span>
      </div>
      <div class="p-4">
        <h3 class="text-lg font-bold uppercase">BOXES</h3>
      </div>
    </a>
  </div>

  <!-- Button -->
  <div class="mt-8">
    <a href="/catalogo" class="bg-red-600 text-white py-2 px-6 rounded text-lg font-bold hover:bg-gray-800">
      VER CATÁLOGO
    </a>
  </div>
</section>

  <!-- Why Us Section -->
  <section class="bg-gray-200 py-16 text-center">
    <h3 class="text-3xl font-bold mb-8 text-gray-900">¿Por qué Nosotros?</h3>
    <div class="max-w-4xl mx-auto">
      <p class="text-lg text-gray-700 mb-6">
        Somos una <span class="font-semibold">marca familiar</span> fundada en el amor por la tradición y el deseo de compartir momentos especiales. Cada pedido que recibimos es tratado con el mismo cariño y dedicación que ponemos en los productos que preparamos para nuestros propios seres queridos.
      </p>
      <p class="text-lg text-gray-700 mb-6">
        Creemos que los <span class="font-semibold">pequeños detalles marcan la diferencia</span>. En cada producto añadimos ese toque especial que hace que se sienta único, auténtico y lleno de calidez. Nos encanta saber que, al recibir nuestros productos, sientes el cuidado y el esfuerzo que ponemos en cada receta, como si lo hubieras preparado tú mismo en casa.
      </p>
      <p class="text-lg text-gray-700 mb-6">
        Desde nuestra familia para la tuya, con la promesa de que cada bocado esté lleno de <span class="font-semibold">sabor, frescura</span> y, sobre todo, de un toque personal que hace que nuestras creaciones se sientan genuinas y auténticas.
      </p>
      <a href="{{ route('aroma.nosotros') }}" class="bg-black text-white px-6 py-2 font-bold rounded hover:bg-gray-800">
        Ver Más
      </a>
    </div>
  </section>
  <!-- Call to Action Section -->
  <section class="container mx-auto py-16 px-6 text-center">
    <div class="bg-gradient-to-r from-gray-200 to-gray-400 p-12 rounded-lg shadow-md">
      <h5 class="text-3xl font-bold mb-4 text-gray-800">Transforma tus Celebraciones</h5>
      <p class="text-gray-700 mb-6 max-w-lg mx-auto">
        Con cada producto que preparamos, ponemos un toque de cariño y dedicación. Sorprende a tus seres queridos con una experiencia única y auténtica.
      </p>
      <button onclick="window.location.href={{ route('aroma.catalogo') }}"
        class="bg-black text-white px-6 py-3 font-bold text-lg rounded hover:bg-gray-800 transition duration-300">
        Descubre Nuestros Productos
      </button>
    </div>
  </section>
  <!-- Gallery Section -->
  <section class="container mx-auto py-12 px-6 text-center">
    <h6 class="text-2xl font-bold mb-6 text-gray-800">Galería de Nuestros Productos</h6>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Gallery Image Card -->
      <div class="bg-gray-300 h-40 rounded overflow-hidden transform transition duration-300 hover:scale-105">
        <img src="{{ asset('images/product1.jpg') }}" alt="Producto 1" class="w-full h-full object-cover">
      </div>
      <div class="bg-gray-300 h-40 rounded overflow-hidden transform transition duration-300 hover:scale-105">
        <img src="{{ asset('images/product2.jpg') }}" alt="Producto 2" class="w-full h-full object-cover">
      </div>
      <div class="bg-gray-300 h-40 rounded overflow-hidden transform transition duration-300 hover:scale-105">
        <img src="{{ asset('images/product3.jpg') }}" alt="Producto 3" class="w-full h-full object-cover">
      </div>
      <div class="bg-gray-300 h-40 rounded overflow-hidden transform transition duration-300 hover:scale-105">
        <img src="{{ asset('images/product4.jpg') }}" alt="Producto 4" class="w-full h-full object-cover">
      </div>
      <!-- Agrega más imágenes según sea necesario -->
    </div>
  </section>

  @endsection