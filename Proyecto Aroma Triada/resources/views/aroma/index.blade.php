@extends('recursos.app')
  @section('title', 'Index')

  @section('content')

  <!-- Hero Section -->
  <section class="bg-cover bg-center py-32 text-center" style="background-image: url({{ asset('images/navidadfondo.jpg') }}); background-size: cover; background-position: center;">
  <div class="flex justify-end px-6 py-16 w-full">
    <!-- Contenedor preventa con fondo blanco y texto rojo -->
    <div class="bg-white text-red-600 px-12 py-8 sm:max-h-screen w-[400px] max-h-fit">
      <h2 class="text-3xl font-bold mb-4 text-right">¡Aprovecha nuestra preventa!</h2>
      <p class="text-lg mb-6 text-right">No te pierdas las ofertas exclusivas disponibles solo por tiempo limitado.</p>
      <a href="#" class="bg-red-600 text-white px-6 py-2 font-bold hover:bg-red-700 rounded">¡Compra Ahora!</a>
    </div>
  </div>
</section>

 

  <!-- Featured Collection Carousel -->
  <section class="container mx-auto py-12 px-6 text-center">
    <h2 class="text-2xl font-bold mb-6">Colección Destacada</h2>

    <!-- Swiper -->
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <!-- Product Cards in the carousel -->
        @foreach ($productosDestacados as $producto)
        <div class="bg-white shadow p-4 rounded">
          <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-40 w-full object-cover mb-4">
          <h3 class="text-sm font-bold text-gray-500">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</h3>
          <p class="text-gray-800 mb-2">{{ $producto->nombre }}</p>
          <p class="text-gray-700 font-bold mb-4">S/{{ number_format($producto->precio, 2) }}</p>
        </div>
        @endforeach
      </div>
      <!-- Add Pagination and Navigation if needed -->
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </section>

  <!-- Swiper Initialization -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      new Swiper('.swiper-container', {
        slidesPerView: 1, // Number of slides to show
        spaceBetween: 10, // Space between slides
        loop: true, // Infinite loop
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 1,
            spaceBetween: 20
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 40
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 50
          },
        }
      });
    });
  </script>

  <section class="container mx-auto py-12 px-8 text-center">
    <h2 class="text-2xl font-bold mb-6">Principales Categorías</h2>
    <div class="flex flex-wrap justify-center gap-15">
      <!-- Category Buttons with Toggle -->
      @foreach ($categorias as $categoria)
      <div class="text-center">
        <button onclick="toggleDescription('{{ $categoria->id_categoria }}')"
          class="bg-gray-300 py-2 px-4 rounded font-bold text-lg focus:outline-none">
          {{ $categoria->nombre }}
        </button>
        <div id="description-{{ $categoria->id_categoria }}"
          class="hidden bg-gray-100 p-2 rounded mt-2 text-sm text-gray-700">
          {{ $categoria->descripcion ?? 'Descripción de la categoría' }}
        </div>
      </div>
      @endforeach
    </div>
  </section>

  <script>
    function toggleDescription(id) {
      const description = document.getElementById('description-' + id);
      description.classList.toggle('hidden');
    }
  </script>

  <!-- Swiper Initialization for Categories -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      new Swiper('.swiper-container-categories', {
        slidesPerView: 1, // Number of slides to show
        spaceBetween: 10, // Space between slides
        loop: true, // Infinite loop
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 30
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 40
          },
        }
      });
    });
  </script>

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