@extends('recursos.app')
@section('title', 'Index')

@section('content')

<!-- Hero Section -->
<section class="bg-gray-200 py-16 text-center">
  <h1 class="text-3xl font-bold mb-2">Texto sobre la promesa de tu negocio</h1>
  <p class="text-gray-700 mb-4">Descripción detallada sobre lo que tu negocio y valores ofrecen.</p>
  <button class="bg-black text-white px-6 py-2 font-bold hover:bg-gray-800">Conócenos</button>
</section>

<!-- Featured Collection -->
<section class="container mx-auto py-12 px-6 text-center">
  <h2 class="text-2xl font-bold mb-6">Colección Destacada</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Product Card -->
    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h3 class="text-sm font-bold text-gray-500">Categoría</h3>
      <p class="text-gray-800 mb-2">Producto 1</p>
      <p class="text-gray-700 font-bold mb-4">$590.00</p>
      <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
    </div>

    <!-- Repeat similar Product Cards for other products -->
    <!-- ... -->
  </div>
</section>

<!-- Categories Section -->
<section class="container mx-auto py-12 px-6 text-center">
  <h2 class="text-2xl font-bold mb-6">Principales Categorías</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Category Card -->
    <div class="bg-gray-300 h-40 rounded flex items-center justify-center">
      <p class="font-bold text-lg">Categoría 1</p>
    </div>

    <!-- Repeat similar Category Cards for other categories -->
    <!-- ... -->
  </div>
  <button class="bg-black text-white px-6 py-2 font-bold mt-6 hover:bg-gray-800">Ver Más</button>
</section>

<!-- Why Us Section -->
<section class="bg-gray-200 py-16 text-center">
  <h3 class="text-2xl font-bold mb-4">¿Por qué Nosotros?</h3>
  <p class="text-gray-700 mb-6 max-w-3xl mx-auto">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur, ut rutrum ipsum.
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur.
  </p>
  <button class="bg-black text-white px-6 py-2 font-bold hover:bg-gray-800">Ver Más</button>
</section>

<!-- Testimonials Section -->
<section class="container mx-auto py-12 px-6 text-center">
  <h4 class="text-2xl font-bold mb-6">Testimonios</h4>
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <!-- Testimonial Card -->
    <div class="bg-white shadow p-6 rounded">
      <p class="text-gray-700 mb-4">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
      </p>
      <div class="flex items-center justify-center space-x-2 mt-4">
        <div class="bg-gray-300 h-10 w-10 rounded-full"></div>
        <div>
          <p class="font-bold">Nombre</p>
          <p class="text-gray-500 text-sm">Descripción</p>
        </div>
      </div>
    </div>

    <!-- Repeat similar Testimonial Cards for other testimonials -->
    <!-- ... -->
  </div>
</section>

<!-- Call to Action Section -->
<section class="container mx-auto py-16 px-6 text-center">
  <div class="bg-gray-200 p-12 rounded">
    <h5 class="text-2xl font-bold mb-4">Llamado a la acción</h5>
    <p class="text-gray-700 mb-6">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur, ut rutrum ipsum.
    </p>
    <button class="bg-black text-white px-6 py-2 font-bold hover:bg-gray-800">Call to Action</button>
  </div>
</section>

<!-- Gallery Section -->
<section class="container mx-auto py-12 px-6 text-center">
  <h6 class="text-2xl font-bold mb-6">Galería</h6>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-gray-300 h-40 rounded"></div>
    <div class="bg-gray-300 h-40 rounded"></div>
    <div class="bg-gray-300 h-40 rounded"></div>
    <div class="bg-gray-300 h-40 rounded"></div>
  </div>
</section>
</div>
@endsection