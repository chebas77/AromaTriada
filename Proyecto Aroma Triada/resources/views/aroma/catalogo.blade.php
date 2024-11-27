@extends('recursos.app')
@section('title', 'Catálogo de Productos')

@section('content')
<!-- Store Banner -->
<section class="bg-gray-200 py-12">
  <div class="container mx-auto text-center">
    <h1 class="text-3xl font-bold mb-2">Tienda</h1>
    <p class="text-gray-700">
      Bienvenido a nuestra tienda, donde encontrarás una selección exclusiva de productos y servicios para tus eventos especiales.
      Desde deliciosos postres y tortas hasta servicios personalizados como decoración y catering. Explora nuestro catálogo y descubre cómo podemos hacer de tu celebración algo único.
    </p>
  </div>
</section>

<!-- Main Content -->
<section class="container mx-auto py-12 px-6 flex flex-col md:flex-row gap-8">
  <!-- Sidebar -->
  <aside class="md:w-1/4">
    <h3 class="text-xl font-bold mb-4">Categorías</h3>
    <form action="{{ route('aroma.catalogo') }}" method="GET" class="bg-white p-4 rounded-lg shadow">
      <ul class="space-y-2">
        @foreach ($categorias as $categoria)
        <li>
          <label class="flex items-center">
            <input
              type="checkbox"
              name="categorias[]"
              value="{{ $categoria->id_categoria }}"
              class="mr-2"
              {{ in_array($categoria->id_categoria, request('categorias', [])) ? 'checked' : '' }}>
            {{ $categoria->nombre }}
          </label>
        </li>
        @endforeach
      </ul>
      <button
        type="submit"
        class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-bold focus:outline-none">
        Filtrar
      </button>
    </form>
  </aside>

  <!-- Product and Service Grid -->
  <div class="md:w-3/4">
    <h2 class="text-lg font-medium mb-6">
      Mostrando {{ $totalResultados }} {{ $totalResultados === 1 ? 'resultado' : 'resultados' }}
    </h2>

    @if ($totalResultados === 0)
    <p>No hay productos ni servicios en esta categoría.</p>
    @else

    <!-- Productos -->
    <div class="mb-12">
      <h3 class="text-lg font-medium mb-4">Productos</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($productos as $producto)
        <div class="bg-white shadow p-4 rounded">
          <div class="bg-gray-300 h-40 mb-4">
            <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/placeholder.png') }}"
              alt="{{ $producto->nombre }}" class="h-full w-full object-cover rounded">
          </div>
          <h4 class="text-sm font-bold text-gray-500">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</h4>
          <p class="text-gray-800 mb-2 font-bold">{{ $producto->nombre }}</p>
          <p class="text-gray-700 font-bold mb-4">S/ {{ number_format($producto->precio, 2) }}</p>

          <!-- Botón que redirige al detalle del producto -->
          <a href="{{ route('detalle.item', ['tipo' => 'producto', 'id' => $producto->id_producto]) }}"
            class="bg-blue-500 text-white px-6 py-2 font-bold hover:bg-blue-600 w-full rounded inline-block text-center">
            Ir a comprar
          </a>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>
@endsection
