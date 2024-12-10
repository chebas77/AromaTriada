@extends('recursos.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="flex items-center justify-center bg-cover bg-center w-full relative" style="background-image: url('{{ asset('images/fondo2.png') }}'); min-height: 86vh;">
        <!-- Capa con opacidad sobre el fondo -->
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <div class="w-full max-w-lg bg-violeta p-10 rounded-xl shadow-2xl z-10">
            <h1 class="text-4xl font-extrabold text-center text-crema3 mb-8">Iniciar Sesión</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Correo Electrónico -->
                <div>
                    <input type="email" name="email" placeholder="Email" 
                        class="w-full px-6 py-3 border border-crema1 rounded-lg shadow-sm focus:ring-2 focus:ring-crema1 focus:outline-none transition ease-in-out duration-300"
                        required>
                    @error('email')
                        <span class="text-violeta text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div>
                    <input type="password" name="password" placeholder="Contraseña" 
                        class="w-full px-6 py-3 border border-crema1 rounded-lg shadow-sm focus:ring-2 focus:ring-crema1 focus:outline-none transition ease-in-out duration-300"
                        required>
                    @error('password')
                        <span class="text-violeta text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Olvidaste tu Contraseña -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('password.request') }}" class="text-sm text-crema3 hover:text-crema1 transition">¿Olvidaste tu contraseña?</a>
                </div>

                <!-- Botón de Inicio de Sesión -->
                <div>
                    <button type="submit" 
                        class="w-full bg-crema1 text-violeta py-3 font-semibold rounded-lg hover:bg-crema3 transition transform hover:scale-105 duration-300">
                        Ingresar
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-crema3 mt-6">¿No tienes cuenta? 
                <a href="{{ route('aroma.registro') }}" class="text-crema3 hover:underline">Regístrate</a>
            </p>
        </div>
    </div>
@endsection
