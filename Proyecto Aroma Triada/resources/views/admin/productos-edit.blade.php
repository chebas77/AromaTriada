@extends('recursos.base_admin')
@section('title', 'Editar Producto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Producto</h1>

    {{-- Formulario para editar producto --}}
    <form action="{{ route('admin.actualizarProducto', $producto->id_producto) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <label for="nombre" class="block text-gray-700 font-bold">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required 
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descripción -->
        <div>
            <label for="descripcion" class="block text-gray-700 font-bold">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" 
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('descripcion', $producto->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Precio -->
        <div>
            <label for="precio" class="block text-gray-700 font-bold">Precio</label>
            <input type="number" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required step="0.01"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('precio')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Imagen -->
        <div>
            <label for="imagen" class="block text-gray-700 font-bold">Imagen</label>
            @if ($producto->imagen)
                <div class="mb-4">
                    <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto" class="w-32 h-32 object-cover rounded">
                    <p class="text-sm text-gray-600 mt-2">Imagen actual</p>
                </div>
            @endif
            <input type="file" id="imagen" name="imagen" accept="image/*"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <p class="text-sm text-gray-600 mt-2">Sube una nueva imagen para reemplazar la existente</p>
            @error('imagen')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Categoría -->
        <div>
            <label for="id_categoria" class="block text-gray-700 font-bold">Categoría</label>
            <select id="id_categoria" name="id_categoria" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Seleccione una categoría</option> <!-- Opción predeterminada vacía -->
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" 
                        {{ old('id_categoria', $producto->id_categoria) == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('id_categoria')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex space-x-4">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Actualizar Producto
            </button>
            <a href="{{ route('admin.gestionarProductos') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
