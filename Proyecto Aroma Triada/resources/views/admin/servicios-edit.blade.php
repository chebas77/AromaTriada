@extends('layouts.app') {{-- Usa el layout principal de Jetstream --}}

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Editar Servicio</h1>

    <form action="{{ route('admin.actualizarServicio', $servicio) }}" method="POST" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 py-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Servicio</label>
            <input type="text" name="nombre" id="nombre" value="{{ $servicio->nombre }}" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $servicio->descripcion }}</textarea>
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-gray-700 font-bold mb-2">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ $servicio->precio }}" step="0.01" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Actualizar Servicio</button>
        </div>
    </form>
</div>
@endsection
