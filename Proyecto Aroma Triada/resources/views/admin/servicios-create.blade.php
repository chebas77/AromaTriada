@extends('recursos.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Crear Nuevo Servicio</h1>

    {{-- Muestra los errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para crear el servicio --}}
    <form action="{{ route('admin.guardarServicio') }}" method="POST">
        @csrf {{-- Token de seguridad obligatorio --}}
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Servicio</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                   class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" 
                      class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-gray-700 font-bold mb-2">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ old('precio') }}" step="0.01" 
                   class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.gestionarServicios') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Servicio</button>
        </div>
    </form>
</div>
<a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
    Regresar
</a>

@endsection
    