@extends('recursos.app')
@section('title', $item->nombre)

@section('content')
<!-- Breadcrumb -->
<div class="container mx-auto py-4 px-6 text-sm text-gray-500">
  <a href="{{ route('aroma.index') }}" class="hover:underline">Inicio</a> / 
  <a href="{{ route('aroma.catalogo') }}" class="hover:underline">Tienda</a> / 
  <a href="#" class="hover:underline">{{ $tipo === 'producto' ? 'Producto' : 'Servicio' }}</a> / {{ $item->nombre }}
</div>

<!-- Product Section -->
<section class="container mx-auto py-12 px-6">
  <div class="flex flex-col md:flex-row gap-8">
    <!-- Product Image -->
    <div class="md:w-1/2">
      <img src="{{ asset($item->imagen) }}" alt="{{ $item->nombre }}" class="w-full h-80 object-cover rounded">
    </div>

    <!-- Product Details -->
    <div class="md:w-1/2">
      <h1 class="text-3xl font-bold mb-4">{{ $item->nombre }}</h1>
      <p class="text-2xl text-gray-700 mb-4">${{ number_format($item->precio, 2) }}</p>
      <p class="text-gray-700 mb-6">{{ $item->descripcion }}</p>

      <!-- Formulario para seleccionar cantidad y agregar al carrito -->
      <form action="{{ route('carrito.agregar') }}" method="POST">
        @csrf
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <input type="hidden" name="id" value="{{ $item->id }}">

        <!-- Selector de cantidad -->
        <div class="mb-6">
          <label for="cantidad" class="block text-gray-700 mb-2">Cantidad:</label>
          <div class="flex items-center">
            <button type="button" onclick="decrement()" class="px-4 py-2 border border-gray-300">-</button>
            <input type="text" id="cantidad" name="cantidad" value="1" class="w-12 text-center border-t border-b border-gray-300" readonly />
            <button type="button" onclick="increment()" class="px-4 py-2 border border-gray-300">+</button>
          </div>
        </div>

        <!-- Botón de agregar al carrito -->
        <button type="submit" class="w-full bg-black text-white py-3 font-bold hover:bg-gray-800">
          AÑADIR AL CARRITO
        </button>
      </form>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
  function increment() {
    let quantityInput = document.getElementById("cantidad");
    let currentValue = parseInt(quantityInput.value);
    if (currentValue < 10) {
      quantityInput.value = currentValue + 1;
    }
  }

  function decrement() {
    let quantityInput = document.getElementById("cantidad");
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
    }
  }
</script>
@endsection
