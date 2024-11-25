@extends('recursos.base_admin')
@section('title', 'Editar Usuario')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>

    {{-- Formulario para editar el usuario --}}
    <form action="{{ route('admin.actualizarUsuario', $usuario->id) }}" method="POST" class="bg-white rounded-lg shadow-md p-6 space-y-4 max-w-lg mx-auto">
        @csrf {{-- Token de seguridad --}}
        {{-- No incluimos @method('PUT') porque usamos POST --}}
        
        <!-- Campo para el nombre -->
        <div>
            <label for="name" class="block text-gray-700 font-bold mb-2">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Campo para el correo electrónico -->
        <div>
            <label for="email" class="block text-gray-700 font-bold mb-2">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Campo para el rol -->
        <div>
            <label for="id_rol" class="block text-gray-700 font-bold mb-2">Rol:</label>
            <select name="id_rol" id="id_rol" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($roles as $rol)
                    <option value="{{ $rol->id_rol }}" {{ old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
            @error('id_rol')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botón para guardar cambios -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

{{-- Botón para regresar --}}
<div class="mt-6 text-center">
    <a href="{{ route('admin.gestionarUsuarios') }}" 
       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
        Regresar
    </a>
</div>
@endsection
