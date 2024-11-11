@extends('recursos.app')
@section('title', 'Cataloguito ')

@section('content', )
<!-- Store Banner -->
<section class="bg-gray-200 py-12">
  <div class="container mx-auto text-center">
    <h1 class="text-3xl font-bold mb-2">Tienda</h1>
    <p class="text-gray-700">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur, ut rutrum ipsum.
    </p>
  </div>
</section>

<!-- Main Content -->
<section class="container mx-auto py-12 px-6 flex flex-col md:flex-row gap-8">
  <!-- Sidebar -->
  <aside class="md:w-1/4">


  <!--CAMBIAR ESTA MRD "FUNCION QUE MUESTRE CATEGORIAS DELAS BASE DE DATOS" -->



    <h3 class="text-xl font-bold mb-4">Categorías</h3>
    <ul class="space-y-2">
      <li><label class="flex items-center"><input type="checkbox" class="mr-2"> Categoría 1</label></li>
      <li><label class="flex items-center"><input type="checkbox" class="mr-2"> Categoría 2</label></li>
      <li><label class="flex items-center"><input type="checkbox" class="mr-2"> Categoría 3</label></li>
      <li><label class="flex items-center"><input type="checkbox" class="mr-2"> Categoría 4</label></li>
      <li><label class="flex items-center"><input type="checkbox" class="mr-2"> Categoría 5</label></li>
      <li><label class="flex items-center"><input type="checkbox" class="mr-2"> Categoría 6</label></li>
    </ul>
  </aside>

  <!-- Product Grid -->
  <div class="md:w-3/4">
    <h2 class="text-lg font-medium mb-6">Mostrando 6 productos</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Product Card -->
      <div class="bg-white shadow p-4 rounded">
        <div class="bg-gray-300 h-40 mb-4"></div>
        <h3 class="text-sm font-bold text-gray-500">Categoría</h3>
        <p class="text-gray-800 mb-2">Producto 1</p>
        <p class="text-gray-700 font-bold mb-4">$590.00</p>
        <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
      </div>

      <div class="bg-white shadow p-4 rounded">
        <div class="bg-gray-300 h-40 mb-4"></div>
        <h3 class="text-sm font-bold text-gray-500">Categoría</h3>
        <p class="text-gray-800 mb-2">Producto 2</p>
        <p class="text-gray-700 font-bold mb-4">$590.00</p>
        <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
      </div>

      <div class="bg-white shadow p-4 rounded">
        <div class="bg-gray-300 h-40 mb-4"></div>
        <h3 class="text-sm font-bold text-gray-500">Categoría</h3>
        <p class="text-gray-800 mb-2">Producto 3</p>
        <p class="text-gray-700 font-bold mb-4">$590.00</p>
        <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
      </div>

      <div class="bg-white shadow p-4 rounded">
        <div class="bg-gray-300 h-40 mb-4"></div>
        <h3 class="text-sm font-bold text-gray-500">Categoría</h3>
        <p class="text-gray-800 mb-2">Producto 4</p>
        <p class="text-gray-700 font-bold mb-4">$590.00</p>
        <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
      </div>

      <div class="bg-white shadow p-4 rounded">
        <div class="bg-gray-300 h-40 mb-4"></div>
        <h3 class="text-sm font-bold text-gray-500">Categoría</h3>
        <p class="text-gray-800 mb-2">Producto 5</p>
        <p class="text-gray-700 font-bold mb-4">$590.00</p>
        <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
      </div>

      <div class="bg-white shadow p-4 rounded">
        <div class="bg-gray-300 h-40 mb-4"></div>
        <h3 class="text-sm font-bold text-gray-500">Categoría</h3>
        <p class="text-gray-800 mb-2">Producto 6</p>
        <p class="text-gray-700 font-bold mb-4">$590.00</p>
        <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">AÑADIR AL CARRITO</button>
      </div>
    </div>
  </div>
</section>
@endsection