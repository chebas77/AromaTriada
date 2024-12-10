@extends('recursos.base_admin')
@section('title', 'Gestión de Productos')

@section('content')
<div class="container mx-auto px-6 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Gestión de Productos</h1>

    <!-- Filtro por categoría y disponibilidad -->
    <form action="{{ route('admin.gestionarProductos') }}" method="GET" class="mb-8 flex gap-6 items-center flex-wrap">
        <div class="flex-1 min-w-[200px] max-w-xs">
            <label for="categoria" class="block text-gray-700 font-semibold mb-1">Filtrar por Categoría:</label>
            <select id="categoria" name="categoria" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas</option>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id_categoria }}" {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 min-w-[200px] max-w-xs">
            <label for="disponibilidad" class="block text-gray-700 font-semibold mb-1">Filtrar por Disponibilidad:</label>
            <select id="disponibilidad" name="disponibilidad" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas</option>
                <option value="1" {{ request('disponibilidad') == '1' ? 'selected' : '' }}>Disponible</option>
                <option value="0" {{ request('disponibilidad') == '0' ? 'selected' : '' }}>No Disponible</option>
            </select>
        </div>

        <div class="flex-shrink-0 flex gap-4 justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Filtrar</button>
            <a href="{{ route('admin.gestionarProductos') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-300">Restablecer</a>
        </div>
    </form>

    <!-- Tabla de productos -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <table class="w-full table-fixed border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm leading-normal">
                <th class="border px-4 py-3 w-20">Imagen</th>
                <th class="border px-4 py-3 w-40">Nombre</th>
                <th class="border px-4 py-3 w-40">Categoría</th>
                <th class="border px-4 py-3">Descripción</th>
                <th class="border px-4 py-3 w-24">Precio</th>
                <th class="border px-4 py-3 w-32 text-center">Disponibilidad</th>
                <th class="border px-4 py-3 w-24 text-center">Stock</th>
                <th class="border px-4 py-3 w-40 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm">
            @forelse ($productos as $producto)
                <tr class="bg-white hover:bg-gray-50 transition duration-300">
                    <!-- Imagen -->
                    <td class="border px-4 py-2 text-center">
                        @if($producto->imagen)
                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-12 w-12 object-cover rounded-md mx-auto">
                        @else
                            <span class="text-gray-500 italic">Sin imagen</span>
                        @endif
                    </td>
                    <!-- Nombre -->
                    <td class="border px-4 py-2 truncate">{{ $producto->nombre }}</td>
                    <!-- Categoría -->
                    <td class="border px-4 py-2 truncate">{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</td>
                    <!-- Descripción -->
                    <td class="border px-4 py-2 truncate">{{ $producto->descripcion }}</td>
                    <!-- Precio -->
                    <td class="border px-4 py-2 text-right">S/{{ number_format($producto->precio, 2) }}</td>
                    <!-- Disponibilidad -->
                    <td class="border px-4 py-2 text-center">
                        <form action="{{ route('admin.actualizarDisponibilidad', $producto) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <label class="inline-flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" name="disponibilidad" onchange="this.form.submit()" class="hidden" {{ $producto->disponibilidad ? 'checked' : '' }} />
                                    <div class="w-12 h-6 rounded-full transition-colors duration-300 ease-in-out 
                                        {{ $producto->disponibilidad ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                    <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300 
                                        {{ $producto->disponibilidad ? 'transform translate-x-6' : 'transform translate-x-0' }}"></div>
                                </div>
                            </label>
                        </form>
                    </td>
                    <!-- Stock -->
                    <td class="border px-4 py-2 text-center">{{ $producto->stock }}</td>
                    <!-- Acciones -->
                    <td class="border px-4 py-2 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.editarProducto', $producto) }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-400 transition duration-300">Editar</a>
                            <form action="{{ route('admin.eliminarProducto', $producto) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-400 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition duration-300">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500 italic">No se encontraron productos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <!-- Paginación con appends para mantener los filtros -->
    @if ($productos instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-6">
        {{ $productos->appends([
            'categoria' => request('categoria'),
            'disponibilidad' => request('disponibilidad')
        ])->links() }}
    </div>
    @endif
</div>

<!-- Botón para crear un nuevo producto -->
<a href="{{ route('admin.crearProducto') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg mt-8 inline-block">Crear Producto</a>

@endsection
