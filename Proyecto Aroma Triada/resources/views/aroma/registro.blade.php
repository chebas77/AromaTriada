<!-- resources/views/auth/register.blade.php -->
@extends('recursos.auth') <!-- Extiende de la plantilla auth.blade.php, que tiene los headers y footers especializados -->

@section('title', 'Registro de Usuario')

@section('content')
<h1 class="text-2xl font-bold text-center mb-8">Crear una Cuenta</h1>
<form method="POST" action="{{ route('register') }}" class="space-y-6">
    @csrf

    <!-- Nombre -->
    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="name">Nombre</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" 
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Nombre Completo" required autofocus>
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Correo Electrónico -->
    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="email">Correo Electrónico</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" 
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="correo@example.com" required>
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Contraseña -->
    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="password">Contraseña</label>
        <input id="password" name="password" type="password" 
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Contraseña" required>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Confirmar Contraseña -->
    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="password_confirmation">Confirmar Contraseña</label>
        <input id="password_confirmation" name="password_confirmation" type="password" 
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Confirmar Contraseña" required>
    </div>

    <!-- Botón de Registro -->
    <button type="submit" class="w-full bg-black text-white py-2 font-semibold rounded hover:bg-gray-800">Registrarse</button>
</form>

<p class="text-center text-gray-600 mt-6">
    ¿Ya tienes una cuenta?
    <a href="{{ route('aroma.inicioSesion') }}" class="text-blue-500 hover:underline">Inicia Sesión</a>
</p>
@endsection
