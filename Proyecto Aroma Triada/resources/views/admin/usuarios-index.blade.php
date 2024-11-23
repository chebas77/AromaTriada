@extends('recursos.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Gestión de Usuarios</h1>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla de usuarios --}}
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2 bg-gray-100">Nombre</th>
                    <th class="border px-4 py-2 bg-gray-100">Correo Electrónico</th>
                    <th class="border px-4 py-2 bg-gray-100">Rol</th>
                    <th class="border px-4 py-2 bg-gray-100">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td class="border px-4 py-2">{{ $usuario->name }}</td>
                    <td class="border px-4 py-2">{{ $usuario->email }}</td>
                    <td class="border px-4 py-2">
                        {{ $usuario->rol ? $usuario->rol->nombre : 'Sin Rol' }}
                    </td>
                    <td class="border px-4 py-2 text-center">
                        {{-- Botón de Editar --}}
                        <a href="{{ route('admin.editarUsuario', $usuario) }}" 
                           class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
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
