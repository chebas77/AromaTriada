@extends('recursos.base_admin')
@section('title', 'Editar Servicio')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Servicio</h1>

    {{-- Formulario para editar el servicio --}}
    <form action="{{ route('admin.actualizarServicio', $servicio->id_servicio) }}" method="POST" class="bg-white rounded-lg shadow-md p-6 space-y-4">
        @csrf
        @method('PUT') {{-- Método HTTP PUT --}}

        <!-- Nombre del Servicio -->
        <div>
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Servicio:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $servicio->nombre) }}" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('nombre')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Descripción -->
        <div>
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" 
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion', $servicio->descripcion) }}</textarea>
            @error('descripcion')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Precio -->
        <div>
            <label for="precio" class="block text-gray-700 font-bold mb-2">Precio:</label>
            <input type="number" name="precio" id="precio" value="{{ old('precio', $servicio->precio) }}" step="0.01" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('precio')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones de Acción -->
        <div class="flex items-center space-x-4">
            <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                Confirmar Editar
            </button>
            <a href="{{ route('admin.gestionarServicios') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
