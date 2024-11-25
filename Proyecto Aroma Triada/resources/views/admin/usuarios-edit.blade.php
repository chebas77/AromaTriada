@extends('recursos.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

    {{-- Formulario para editar el usuario --}}
    <form action="{{ route('admin.actualizarUsuario', $usuario->id) }}" method="POST" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 py-6">
        @csrf
        {{-- No incluimos @method('PUT') porque usamos POST --}}

        {{-- Campo para el nombre --}}
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nombre</label>
            <input type="text" name="name" id="name" value="{{ $usuario->name }}" 
                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Campo para el correo electrónico --}}
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Correo electrónico</label>
            <input type="email" name="email" id="email" value="{{ $usuario->email }}" 
                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Campo para el rol --}}
        <div class="mb-4">
            <label for="id_rol" class="block text-gray-700 font-bold mb-2">Rol</label>
            <select name="id_rol" id="id_rol" 
                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($roles as $rol)
                    <option value="{{ $rol->id_rol }}" {{ $usuario->id_rol == $rol->id_rol ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botón para confirmar cambios --}}
        <div class="flex justify-end">
            <button type="submit" 
                class="bg-red-600 text-white px-6 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

{{-- Botón para regresar a la página anterior --}}
<a href="{{  route('admin.index') }}" 
    class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-600">
    Regresar
</a>
@endsection
