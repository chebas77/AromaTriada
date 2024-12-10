<!-- resources/views/auth/register.blade.php -->
@extends('recursos.auth') <!-- Extiende de la plantilla auth.blade.php, que tiene los headers y footers especializados -->

@section('title', 'Registro de Usuario')

@section('content')

<div class="flex items-center justify-center bg-cover bg-center w-full relative" style="background-image: url('{{ asset('images/fondo2.png') }}'); min-height: 86vh;">
        <!-- Capa con opacidad sobre el fondo -->
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="w-full max-w-lg bg-violeta p-10 rounded-xl shadow-2xl z-10">
<h1 class="text-4xl font-extrabold text-center text-crema3 mb-8">Crear una Cuenta</h1>
<form method="POST" action="{{ route('register') }}" class="space-y-6">
    @csrf

    <!-- Nombre -->
    <div>
        <label class="block text-crema3 font-semibold mb-2" for="name">Nombre</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" 
               class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
               placeholder="Nombre Completo" required autofocus>
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Correo Electrónico -->
    <div>
        <label class="block text-crema3 font-semibold mb-2" for="email">Correo Electrónico</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" 
               class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
               placeholder="correo@example.com" required>
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Teléfono -->
            <div>
                <label for="telefono" class="block text-crema3 font-semibold mb-2">Teléfono</label>
                <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}" 
                       class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
                       placeholder="Número de Teléfono" required minlength="9" maxlength="12">
                @error('telefono')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

    <!-- Contraseña -->
    <div>
        <label class="block text-crema3 font-semibold mb-2" for="password">Contraseña</label>
        <input id="password" name="password" type="password" 
               class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-4 focus:ring-crema1"
               placeholder="Contraseña" required>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Confirmar Contraseña -->
    <div>
        <label class="block text-crema3 font-semibold mb-2" for="password_confirmation">Confirmar Contraseña</label>
        <input id="password_confirmation" name="password_confirmation" type="password" 
               class="w-full px-4 py-2 border border-crema1 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
               placeholder="Confirmar Contraseña" required>
    </div>

    <!-- Botón de Registro -->
    <button type="submit" class="w-full bg-crema1 text-violeta py-3 font-semibold rounded-lg hover:bg-crema3 transition transform hover:scale-105 duration-300">Registrarse</button>
</form>

<p class="text-center text-crema3 mt-6">
    ¿Ya tienes una cuenta?
    <a href="{{ route('aroma.inicioSesion') }}" class="text-crema3 hover:underline">Inicia Sesión</a>
</p>
</div>
@endsection
