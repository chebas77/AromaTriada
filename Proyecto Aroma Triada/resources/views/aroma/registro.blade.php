<!-- resources/views/register.blade.php -->
@extends('recursos.app')

@section('title', 'Registro de Usuario')

@section('content')
<div class="flex justify-center mt-12">
    <!-- Registration Form -->
    <section class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Crear una Cuenta</h2>
        <form class="space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="name">Nombre</label>
                <input id="name" type="text" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black" placeholder="Nombre Completo">
            </div>
            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="email">Correo Electrónico</label>
                <input id="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black" placeholder="correo@example.com">
            </div>
            <!-- Password -->
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="password">Contraseña</label>
                <input id="password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black" placeholder="Contraseña">
            </div>
            <!-- Confirm Password -->
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="confirm-password">Confirmar Contraseña</label>
                <input id="confirm-password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black" placeholder="Confirmar Contraseña">
            </div>
            <!-- Register Button -->
            <button type="submit" class="w-full bg-black text-white py-2 font-bold rounded hover:bg-gray-800">Registrarse</button>
        </form>
        <p class="text-center text-gray-600 mt-6">
            ¿Ya tienes una cuenta?
            <a href="#" class="text-blue-500 hover:underline">Inicia Sesión</a>
        </p>
    </section>
</div>
@endsection
