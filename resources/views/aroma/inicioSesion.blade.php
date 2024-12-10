<!-- resources/views/auth/login.blade.php -->
@extends('recursos.auth') <!-- Extiende de la plantilla auth.blade.php, que tiene los headers y footers especializados -->

@section('title', 'Iniciar Sesión')

@section('content')
<h1 class="text-2xl font-bold text-center mb-8">Iniciar Sesión</h1>
<form method="POST" action="{{ route('login') }}" class="space-y-6">
    @csrf

    <!-- Correo Electrónico -->
    <div>
        <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Ingresa tu correo electrónico" required autofocus>
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Contraseña -->
    <div>
        <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
        <input type="password" id="password" name="password"
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Ingresa tu contraseña" required>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Olvidaste tu Contraseña -->
    <div class="flex justify-between items-center">
        <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-gray-700">¿Olvidaste tu contraseña?</a>
    </div>

    <!-- Botón de Inicio de Sesión -->
    <button type="submit" class="w-full bg-black text-white py-2 font-semibold rounded hover:bg-gray-800">Iniciar Sesión</button>
</form>

<p class="text-center text-gray-600 mt-6">
    ¿No tienes una cuenta?
    <a href="{{ route('aroma.registro') }}" class="text-blue-500 hover:underline">Regístrate aquí</a>
</p>
@endsection
