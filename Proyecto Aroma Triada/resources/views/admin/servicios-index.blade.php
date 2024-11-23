@extends('recursos.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Gestión de Servicios</h1>
    <a href="{{ route('admin.crearServicio') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Crear Servicio</a>

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
                @foreach ($servicios as $servicio)
                <tr>
                    <td class="border px-4 py-2">{{ $servicio->nombre }}</td>
                    <td class="border px-4 py-2">{{ $servicio->descripcion }}</td>
                    <td class="border px-4 py-2">${{ number_format($servicio->precio, 2) }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.editarServicio', $servicio) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                        <form action="{{ route('admin.eliminarServicio', $servicio) }}" method="POST" class="inline">
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
<a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
    Regresar
</a>

@endsection
