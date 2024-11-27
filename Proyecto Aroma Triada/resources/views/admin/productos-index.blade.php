@extends('recursos.base_admin')
@section('title', 'Gestión de Productos')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Gestión de Productos</h1>

    <!-- Filtro por categoría -->
    <form action="{{ route('admin.gestionarProductos') }}" method="GET" class="mb-6 flex items-center space-x-4">
        <div>
            <label for="categoria" class="block text-gray-700 font-bold mb-1">Filtrar por Categoría:</label>
            <select id="categoria" name="categoria" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Todas</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}" 
                        {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Filtrar
            </button>
            <a href="{{ route('admin.gestionarProductos') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Restablecer
            </a>
        </div>
    </form>

    <!-- Tabla de productos -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2 bg-gray-100">Imagen</th>
                    <th class="border px-4 py-2 bg-gray-100">Nombre</th>
                    <th class="border px-4 py-2 bg-gray-100">Categoría</th>
                    <th class="border px-4 py-2 bg-gray-100">Descripción</th>
                    <th class="border px-4 py-2 bg-gray-100">Precio</th>
                    <th class="border px-4 py-2 bg-gray-100">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                    <tr>
                        <td class="border px-4 py-2">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-12 w-12 object-cover">
                            @else
                                <span>Sin imagen</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $producto->nombre }}</td>
                        <td class="border px-4 py-2">{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</td>
                        <td class="border px-4 py-2">{{ $producto->descripcion }}</td>
                        <td class="border px-4 py-2">${{ number_format($producto->precio, 2) }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.editarProducto', $producto) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                            <form action="{{ route('admin.eliminarProducto', $producto) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No se encontraron productos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<a href="{{ route('admin.crearProducto') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Crear Producto</a>

@endsection
