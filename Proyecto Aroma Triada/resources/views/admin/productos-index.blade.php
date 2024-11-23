@extends('layouts.app') {{-- Usa el layout principal de Jetstream --}}

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Gestión de Productos</h1>
    <a href="{{ route('admin.crearProducto') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Crear Producto</a>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2 bg-gray-100">Nombre</th>
                    <th class="border px-4 py-2 bg-gray-100">Descripción</th>
                    <th class="border px-4 py-2 bg-gray-100">Precio</th>
                    <th class="border px-4 py-2 bg-gray-100">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td class="border px-4 py-2">{{ $producto->nombre }}</td>
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
