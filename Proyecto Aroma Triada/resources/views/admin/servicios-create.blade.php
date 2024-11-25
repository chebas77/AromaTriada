@extends('recursos.base_admin')
@section('title', 'Crear Nuevo Servicio')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Crear Nuevo Servicio</h1>

    {{-- Muestra los errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para crear el servicio --}}
    <form action="{{ route('admin.guardarServicio') }}" method="POST" class="bg-white rounded-lg shadow-md p-6 space-y-4">
        @csrf {{-- Token de seguridad obligatorio --}}
        
        <!-- Nombre del Servicio -->
        <div>
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Servicio:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Descripción -->
        <div>
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" 
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion') }}</textarea>
        </div>

        <!-- Precio -->
        <div>
            <label for="precio" class="block text-gray-700 font-bold mb-2">Precio:</label>
            <input type="number" name="precio" id="precio" value="{{ old('precio') }}" step="0.01" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Botones -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.gestionarServicios') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Cancelar
            </a>
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Guardar Servicio
            </button>
        </div>
    </form>
</div>
@endsection
