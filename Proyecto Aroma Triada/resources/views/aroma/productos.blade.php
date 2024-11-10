@extends('recursos.app')
@section('title', 'Productos')

@section('content')


<!-- Breadcrumb -->
<div class="container mx-auto py-4 px-6 text-sm text-gray-500">
  <a href="#" class="hover:underline">Inicio</a> / <a href="#" class="hover:underline">Tienda</a> /
  <a href="#" class="hover:underline">Categoría</a> / Producto 1
</div>

<!-- Product Section -->
<section class="container mx-auto py-12 px-6">
  <div class="flex flex-col md:flex-row gap-8">
    <!-- Product Image -->
    <div class="md:w-1/2 bg-gray-300 h-80"></div>

    <!-- Product Details -->
    <div class="md:w-1/2">
      <h1 class="text-3xl font-bold mb-4">Producto 1</h1>
      <p class="text-2xl text-gray-700 mb-4">$590.00</p>
      <p class="text-gray-700 mb-6">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur, ut rutrum ipsum. Lorem ipsum
        dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur.
      </p>
      <div class="mb-6">
        <label for="size" class="block text-gray-700 mb-2">Seleccionar tamaño:</label>
        <select id="size" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-black">
          <option>Small</option>
          <option>Medium</option>
          <option>Large</option>
        </select>
      </div>
      <div class="flex items-center mb-6">
        <button class="px-4 py-2 border border-gray-300">-</button>
        <input type="text" value="1" class="w-12 text-center border-t border-b border-gray-300" />
        <button class="px-4 py-2 border border-gray-300">+</button>
      </div>
      <button class="w-full bg-black text-white py-3 font-bold hover:bg-gray-800">
        AÑADIR AL CARRITO
      </button>
    </div>
  </div>
</section>

<!-- Related Products Section -->
<section class="container mx-auto py-12 px-6">
  <h2 class="text-2xl font-bold mb-6">Productos Relacionados</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Related Product Card -->
    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h3 class="text-lg font-bold mb-2">Categoría</h3>
      <p class="text-gray-700 mb-2">Producto 1</p>
      <p class="text-gray-700 font-bold mb-4">$590.00</p>
      <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h3 class="text-lg font-bold mb-2">Categoría</h3>
      <p class="text-gray-700 mb-2">Producto 2</p>
      <p class="text-gray-700 font-bold mb-4">$590.00</p>
      <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h3 class="text-lg font-bold mb-2">Categoría</h3>
      <p class="text-gray-700 mb-2">Producto 3</p>
      <p class="text-gray-700 font-bold mb-4">$590.00</p>
      <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h3 class="text-lg font-bold mb-2">Categoría</h3>
      <p class="text-gray-700 mb-2">Producto 4</p>
      <p class="text-gray-700 font-bold mb-4">$590.00</p>
      <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
    </div>
  </div>
</section>
</div>

@endsection