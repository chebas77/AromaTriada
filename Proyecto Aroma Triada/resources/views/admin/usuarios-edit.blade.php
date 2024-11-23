@extends('recursos.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('admin.actualizarUsuario', $usuario) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-bold mb-2">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $usuario->name) }}" class="w-full border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-bold mb-2">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" class="w-full border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="id_rol" class="block text-sm font-bold mb-2">Rol</label>
            
        <select id="id_rol" name="id_rol" class="w-full border-gray-300 rounded">
        @foreach ($roles as $rol)
        <option value="{{ $rol['id_rol'] }}" {{ $usuario->id_rol == $rol['id_rol'] ? 'selected' : '' }}>
            {{ $rol['nombre'] }}
        </option>
        @endforeach
        </select>

        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Cambios</button>
        </div>
    </form>
</div>
<a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
    Regresar
</a>

@endsection
