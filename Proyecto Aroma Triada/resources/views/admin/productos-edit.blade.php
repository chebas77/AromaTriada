@extends('recursos.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>

    {{-- Formulario para editar el producto --}}
    <form action="{{ route('admin.actualizarProducto', $producto->id_producto) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Campo para el nombre --}}
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Producto:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('nombre')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Campo para la descripción --}}
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción:</label>
            <textarea name="descripcion" id="descripcion"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion', $producto->descripcion) }}</textarea>
            @error('descripcion')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Campo para el precio --}}
        <div class="mb-4">
            <label for="precio" class="block text-gray-700 font-bold mb-2">Precio:</label>
            <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('precio')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Botones de acción --}}
        <div class="flex justify-between">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Guardar Cambios
            </button>
            <a href="{{ route('admin.gestionarProductos') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Cancelar
            </a>
        </div>
    </form>
</div>
<a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
    Regresar
</a>

@endsection
